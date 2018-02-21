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
                for ($j = 0; $j < count($tasks[$i]['actors']); $j++){
                    $actor_id = $tasks[$i]['actors'][$j]['id'];

                    if(!array_key_exists($actor_id,$actors)){
                        $actors[$actor_id]['actor_id'] = $tasks[$i]['actors'][$j]['id'].' actor -';
                        $actors[$actor_id]['actor_name'] = $tasks[$i]['actors'][$j]['name'];
                        $actors[$actor_id]['task_ids'][0] = (int)$tasks[$i]['actors'][$j]['task_id'];
                    }
                    else{
                        $actors[$actor_id]['task_ids'][count($actors[$actor_id]['task_ids'])] = (int)$tasks[$i]['actors'][$j]['task_id'];
                    }
                }
            }
        }

        $this->response->html(
            $this->helper->layout->task(
                'usecase:task/show',
                    [
                        'title' => '',
                        'task' => $tasks,
                        'graphs' => $graphs,
                        'actors' => $actors,
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
                'color' => $this->colorModel->getColorProperties($task['color_id']),
                'actors' => $task['actors']
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
