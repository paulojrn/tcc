<?php

namespace Kanboard\Plugin\Usecase\Controller;

use Kanboard\Controller\BaseController;

class UseCase extends BaseController
{
    public function show()
    {
        $project = $this->getProject();
        $search = $this->helper->projectHeader->getSearchQuery($project);
        $tasks = $this->taskLexer
        ->build($search)
        ->format($this->boardFormatter->withProjectId($project['id']));
        $task = $tasks[0]['columns'][0]['tasks'][0];
        
        /*$this->response->html($this->helper->layout->app('use_case/diagram', array(
         'project' => $project,
         'task' => $tasks[0]['column'][0]['tasks'],
         'title' => $project['name'],
         'description' => $this->helper->projectHeader->getDescription($project),
         'board_private_refresh_interval' => $this->configModel->get('board_private_refresh_interval'),
         'board_highlight_period' => $this->configModel->get('board_highlight_period'),
         'swimlanes' => $this->taskLexer
         ->build($search)
         ->format($this->boardFormatter->withProjectId($project['id']))
         )));*/
        //var_dump($tasks[0]['columns'][0]['tasks']);die;
        
        $graph = $this->createGraph($task);
        
        $this->response->html(
            $this->helper->layout->task(
                'usecase:task/show',
                [
                    'title' => $task['title'],
                    'task' => $task,
                    'graph' => $graph,
                    'project' => $this->projectModel->getById($task['project_id'])
                ]
                )
            );
    }
    
    /**
     * @param $task
     * @return array
     * @throws \Exception
     */
    protected function createGraph($task)
    {
        $graph = [];
        $graph['tasks'] = [];
        $graph['edges'] = [];
        
        $this->traverseGraph($graph, $task);
        
        $graphData = [
            'nodes' => $graph['tasks'],
            'edges' => $graph['edges']
        ];
        
        return $graphData;
    }
    
    protected function traverseGraph(&$graph, $task)
    {
        if (!isset($graph['tasks'][$task['id']])) {
            $graph['tasks'][$task['id']] = [
                'id' => $task['id'],
                'title' => $task['title'],
                'active' => $task['is_active'],
                'project_id' => $task['project_id'],
                'project' => $task['project_name'],
                'score'=> $task['score'],
                'column' => $task['column_title'],
                'priority' => $task['priority'],
                'assignee' => $task['assignee_name'] ?: $task['assignee_username'],
                'color' => $this->colorModel->getColorProperties($task['color_id'])
            ];
        }
        
        foreach ($this->taskLinkModel->getAllGroupedByLabel($task['id']) as $type => $links) {
            foreach ($links as $link) {
                if (!isset($graph['edges'][$task['id']][$link['task_id']]) &&
                    !isset($graph['edges'][$link['task_id']][$task['id']])) {
                        $graph['edges'][$task['id']][$link['task_id']] = $type;
                        
                        $this->traverseGraph(
                            $graph,
                            $this->taskFinderModel->getDetails($link['task_id'])
                            );
                    }
            }
        }
    }
}
