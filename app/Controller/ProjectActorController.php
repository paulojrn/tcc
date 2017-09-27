<?php

namespace Kanboard\Controller;

use Kanboard\Core\Controller\AccessForbiddenException;

/**
 * Class ProjectActorController
 *
 * @package Kanboard\Controller
 * @author  Paulo
 */
class ProjectActorController extends BaseController
{
    public function index()
    {
        $project = $this->getProject();
        
        $this->response->html($this->helper->layout->project('project_actor/index', array(
            'project' => $project,
            'actors'    => $this->actorModel->getAllByProject($project['id']),
            'title'   => t('Project actor management'),
        )));
    }
    
    public function create(array $values = array(), array $errors = array())
    {
        $project = $this->getProject();
        
        if (empty($values)) {
            $values['project_id'] = $project['id'];
        }
        
        $this->response->html($this->template->render('project_actor/create', array(
            'project' => $project,
            'values'  => $values,
            'errors'  => $errors,
        )));
    }
    
    public function save()
    {
        $project = $this->getProject();
        $values = $this->request->getValues();
        //aqui
        list($valid, $errors) = $this->actorValidator->validateCreation($values);
        
        if ($valid) {
            if ($this->actorModel->create($project['id'], $values['name']) > 0) {
                $this->flash->success(t('Actor created successfully.'));
            } else {
                $this->flash->failure(t('Unable to create this actor.'));
            }
            
            $this->response->redirect($this->helper->url->to('ProjectActorController', 'index', array('project_id' => $project['id'])));
        } else {
            $this->create($values, $errors);
        }
    }
    
    public function edit(array $values = array(), array $errors = array())
    {
        $project = $this->getProject();
        $actor_id = $this->request->getIntegerParam('actor_id');
        $actor = $this->actorModel->getById($actor_id);
        
        if (empty($values)) {
            $values = $actor;
        }
        
        $this->response->html($this->template->render('project_actor/edit', array(
            'project' => $project,
            'actor' => $actor,
            'values'  => $values,
            'errors'  => $errors,
        )));
    }
    
    public function update()
    {
        $project = $this->getProject();
        $actor_id = $this->request->getIntegerParam('actor_id');
        $actor = $this->actorModel->getById($actor_id);
        $values = $this->request->getValues();
        list($valid, $errors) = $this->actorValidator->validateModification($values);
        
        if ($actor['project_id'] != $project['id']) {
            throw new AccessForbiddenException();
        }
        
        if ($valid) {
            if ($this->actorModel->update($values['id'], $values['name'])) {
                $this->flash->success(t('Actor updated successfully.'));
            } else {
                $this->flash->failure(t('Unable to update this actor.'));
            }
            
            $this->response->redirect($this->helper->url->to('ProjectActorController', 'index', array('project_id' => $project['id'])));
        } else {
            $this->edit($values, $errors);
        }
    }
    
    public function confirm()
    {
        $project = $this->getProject();
        $actor_id = $this->request->getIntegerParam('actor_id');
        $actor = $this->actorModel->getById($actor_id);
        
        $this->response->html($this->template->render('project_actor/remove', array(
            'actor' => $actor,
            'project' => $project,
        )));
    }
    
    public function remove()
    {
        $this->checkCSRFParam();
        $project = $this->getProject();
        $actor_id = $this->request->getIntegerParam('actor_id');
        $actor = $this->actorModel->getById($actor_id);
        
        if ($actor['project_id'] != $project['id']) {
            throw new AccessForbiddenException();
        }
        
        if ($this->actorModel->remove($actor_id)) {
            $this->flash->success(t('Actor removed successfully.'));
        } else {
            $this->flash->failure(t('Unable to remove this actor.'));
        }
        
        $this->response->redirect($this->helper->url->to('ProjectActorController', 'index', array('project_id' => $project['id'])));
    }
}
