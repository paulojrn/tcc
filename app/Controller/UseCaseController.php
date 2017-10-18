<?php

namespace Kanboard\Controller;

/**
 * Use case controller
 *
 * @package  Kanboard\Controller
 * @author   Paulo
 */
class UseCaseController extends BaseController
{
    /**
     * Show a use case for a given project
     *
     * @access public
     */
    public function show()
    {
        $project = $this->getProject();
        $search = $this->helper->projectHeader->getSearchQuery($project);
        
        $this->response->html($this->helper->layout->app('use_case/diagram', array(
            'project' => $project,
            'title' => $project['name'],
            'description' => $this->helper->projectHeader->getDescription($project),
            'board_private_refresh_interval' => $this->configModel->get('board_private_refresh_interval'),
            'board_highlight_period' => $this->configModel->get('board_highlight_period'),
            'swimlanes' => $this->taskLexer
            ->build($search)
            ->format($this->boardFormatter->withProjectId($project['id']))
        )));
    }
}