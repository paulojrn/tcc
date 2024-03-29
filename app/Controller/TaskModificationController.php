<?php

namespace Kanboard\Controller;

use Kanboard\Core\Controller\AccessForbiddenException;
use Kanboard\Core\ExternalTask\AccessForbiddenException as ExternalTaskAccessForbiddenException;
use Kanboard\Core\ExternalTask\ExternalTaskException;

/**
 * Task Modification controller
 *
 * @package  Kanboard\Controller
 * @author   Frederic Guillot
 */
class TaskModificationController extends BaseController
{
    /**
     * Set automatically the start date
     *
     * @access public
     */
    public function start()
    {
        $task = $this->getTask();
        $values = array('id' => $task['id'], 'date_started' => time());
        if (! $this->helper->projectRole->canUpdateTask($task)) {
            throw new AccessForbiddenException(t('You are not allowed to update tasks assigned to someone else.'));
        }
        $this->taskModificationModel->update($values);
        $this->response->redirect($this->helper->url->to('TaskViewController', 'show', array('project_id' => $task['project_id'], 'task_id' => $task['id'])));
    }

    /**
     * Display a form to edit a task
     *
     * @access public
     * @param array $values
     * @param array $errors
     * @throws \Kanboard\Core\Controller\AccessForbiddenException
     * @throws \Kanboard\Core\Controller\PageNotFoundException
     */
    public function edit(array $values = array(), array $errors = array())
    {
        $task = $this->getTask();

        if (! $this->helper->projectRole->canUpdateTask($task)) {
            throw new AccessForbiddenException(t('You are not allowed to update tasks or use cases assigned to someone else.'));
        }
        
        $project = $this->projectModel->getById($task['project_id']);

        if (empty($values)) {
            $values = $task;
        }

        $values['actors'] = $this->taskActorModel->getList($task['id']);        
        $values = $this->hook->merge('controller:task:form:default', $values, array('default_values' => $values));
        $values = $this->hook->merge('controller:task-modification:form:default', $values, array('default_values' => $values));
        
        if($task['category_id'] == "1"){
            $params = array(
                'project' => $project,
                'values' => $values,
                'errors' => $errors,
                'task' => $task,
                'tags' => $this->taskTagModel->getList($task['id']),
                'actors' => $this->taskActorModel->getList($task['id']),
                'users_list' => $this->projectUserRoleModel->getAssignableUsersList($task['project_id']),
                'categories_list' => array(1 => "use case")
            );
            
            $this->renderTemplate2($task, $params);
        }
        else       
            if($task['category_id'] == "2"){
                $params = array(
                    'project' => $project,
                    'values' => $values,
                    'errors' => $errors,
                    'task' => $task,
                    'tags' => $this->taskTagModel->getList($task['id']),
                    'actors' => $this->taskActorModel->getList($task['id']),
                    'users_list' => $this->projectUserRoleModel->getAssignableUsersList($task['project_id']),
                    'categories_list' => array(2 => "slice")
                );
                
                $this->renderTemplate3($task, $params);
                
            }
            else{
                $params = array(
                    'project' => $project,
                    'values' => $values,
                    'errors' => $errors,
                    'task' => $task,
                    'tags' => $this->taskTagModel->getList($task['id']),
                    'actors' => $this->taskActorModel->getList($task['id']),
                    'users_list' => $this->projectUserRoleModel->getAssignableUsersList($task['project_id']),
                    'categories_list' => $this->categoryModel->getList($task['project_id']),
                );
                
                $this->renderTemplate($task, $params);
            }
        
        
    }

    protected function renderTemplate(array &$task, array &$params)
    {
        if (empty($task['external_uri'])) {
            $this->response->html($this->template->render('task_modification/show', $params));
        } else {

            try {
                $taskProvider = $this->externalTaskManager->getProvider($task['external_provider']);
                $params['template'] = $taskProvider->getModificationFormTemplate();
                $params['external_task'] = $taskProvider->fetch($task['external_uri']);
            } catch (ExternalTaskAccessForbiddenException $e) {
                throw new AccessForbiddenException($e->getMessage());
            } catch (ExternalTaskException $e) {
                $params['error_message'] = $e->getMessage();
            }

            $this->response->html($this->template->render('external_task_modification/show', $params));
        }
    }
    
    protected function renderTemplate2(array &$task, array &$params)
    {
        if (empty($task['external_uri'])) {
            $this->response->html($this->template->render('task_modification/show2', $params));
        } else {
            
            try {
                $taskProvider = $this->externalTaskManager->getProvider($task['external_provider']);
                $params['template'] = $taskProvider->getModificationFormTemplate();
                $params['external_task'] = $taskProvider->fetch($task['external_uri']);
            } catch (ExternalTaskAccessForbiddenException $e) {
                throw new AccessForbiddenException($e->getMessage());
            } catch (ExternalTaskException $e) {
                $params['error_message'] = $e->getMessage();
            }
            
            $this->response->html($this->template->render('external_task_modification/show', $params));
        }
    }
    
    protected function renderTemplate3(array &$task, array &$params)
    {
        if (empty($task['external_uri'])) {
            $this->response->html($this->template->render('task_modification/show3', $params));
        } else {
            
            try {
                $taskProvider = $this->externalTaskManager->getProvider($task['external_provider']);
                $params['template'] = $taskProvider->getModificationFormTemplate();
                $params['external_task'] = $taskProvider->fetch($task['external_uri']);
            } catch (ExternalTaskAccessForbiddenException $e) {
                throw new AccessForbiddenException($e->getMessage());
            } catch (ExternalTaskException $e) {
                $params['error_message'] = $e->getMessage();
            }
            
            $this->response->html($this->template->render('external_task_modification/show', $params));
        }
    }

    /**
     * Validate and update a task
     *
     * @access public
     */
    public function update()
    {
        $task = $this->getTask();
        $values = $this->request->getValues();

        list($valid, $errors) = $this->taskValidator->validateModification($values);

        if ($valid && $this->updateTask($task, $values, $errors)) {
            $this->flash->success(t('Task updated successfully.'));
            $this->response->redirect($this->helper->url->to('TaskViewController', 'show', array('project_id' => $task['project_id'], 'task_id' => $task['id'])), true);
        } else {
            $this->flash->failure(t('Unable to update your task.'));
            $this->edit($values, $errors);
        }
    }
    
    /**
     * Validate and update a use case
     *
     * @access public
     */
    public function update2()
    {
        $task = $this->getTask();
        $values = $this->request->getValues();
        
        list($valid, $errors) = $this->taskValidator->validateModification($values);
        $errors["use_case"] = false;

        if (!$values["actors"][1]) {
            $this->flash->failure(t('Unable to update your use case.'));
            $errors["use_case"] = true;
            $this->edit($values, $errors);
        } else
            {
                if ($valid && $this->updateTask($task, $values, $errors)) {
                    $this->flash->success(t('Task updated successfully.'));
                    $this->response->redirect($this->helper->url->to('TaskViewController', 'show', array('project_id' => $task['project_id'], 'task_id' => $task['id'])), true);
                } else {
                    $this->flash->failure(t('Unable to update your task.'));
                    $this->edit($values, $errors);
                }
            }        
    }

    protected function updateTask(array &$task, array &$values, array &$errors)
    {
        if (isset($values['owner_id']) && $values['owner_id'] != $task['owner_id'] && !$this->helper->projectRole->canChangeAssignee($task)) {
            throw new AccessForbiddenException(t('You are not allowed to change the assignee.'));
        }
        
        if (! $this->helper->projectRole->canUpdateTask($task)) {
            throw new AccessForbiddenException(t('You are not allowed to update tasks assigned to someone else.'));
        }

        $result = $this->taskModificationModel->update($values);

        if ($result && ! empty($task['external_uri'])) {
            try {
                $taskProvider = $this->externalTaskManager->getProvider($task['external_provider']);
                $result = $taskProvider->save($task['external_uri'], $values, $errors);
            } catch (ExternalTaskAccessForbiddenException $e) {
                throw new AccessForbiddenException($e->getMessage());
            } catch (ExternalTaskException $e) {
                $this->logger->error($e->getMessage());
                $result = false;
            }
        }

        return $result;
    }
}
