<?php

namespace Kanboard\Plugin\Usecase\Controller;

use Kanboard\Controller\BaseController;

class UseCase extends BaseController
{
    public function show()
    {
        $project = $this->getProject();
        $search = $this->helper->projectHeader->getSearchQuery($project);
        $tasks_tree = $this->taskLexer
        ->build($search)
        ->format($this->boardFormatter->withProjectId($project['id']));
        $tasks = $tasks_tree[0]['columns'][0]['tasks'];
        
        //ver quando for projetos diferentes
        //só criar slice dentro ou depois do caso de uso
        //se um caso de uso andar no board, o slice anda junto ou impossibilita o caso de uso de andar
        //se todos os slices terminarem o caso de uso também acaba?
        //fazer o ator aparecer no gráfico
        
        for ($i = 0; $i < count($tasks); $i++){
            if(strcmp($tasks[$i]['category_name'], "use case") == 0){
                $graphs[$i] = $this->createGraph($tasks[$i]);
            }
        }
        
        $this->response->html(
            $this->helper->layout->task(
                'usecase:task/show',
                    [
                        'title' => '', //inutilizado
                        'task' => $tasks,
                        'graphs' => $graphs,
                        'project' => $this->projectModel->getById($project['id'])
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
