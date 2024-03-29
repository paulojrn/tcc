<?php

namespace Kanboard\Helper;

use Kanboard\Core\Base;

/**
 * Task helpers
 *
 * @package helper
 * @author  Frederic Guillot
 */
class TaskHelper extends Base
{
    /**
     * Local cache for project columns
     *
     * @access private
     * @var array
     */
    private $columns = array();

    public function getColors()
    {
        return $this->colorModel->getList();
    }

    public function recurrenceTriggers()
    {
        return $this->taskRecurrenceModel->getRecurrenceTriggerList();
    }

    public function recurrenceTimeframes()
    {
        return $this->taskRecurrenceModel->getRecurrenceTimeframeList();
    }

    public function recurrenceBasedates()
    {
        return $this->taskRecurrenceModel->getRecurrenceBasedateList();
    }

    public function renderTitleField(array $values, array $errors)
    {
        return $this->helper->form->text(
            'title',
            $values,
            $errors,
            array(
                'autofocus',
                'required',
                'maxlength="200"',
                'tabindex="1"',
                'placeholder="'.t('Title').'"'
            )
        );
    }

    public function renderDescriptionField(array $values, array $errors)
    {
        return $this->helper->form->textEditor('description', $values, $errors, array('tabindex' => 2));
    }

    public function renderTagField(array $project, array $tags = array())
    {
        $options = $this->tagModel->getAssignableList($project['id']);

        $html = $this->helper->form->label(t('Tags'), 'tags[]');
        $html .= '<input type="hidden" name="tags[]" value="">';
        $html .= '<select name="tags[]" id="form-tags" class="tag-autocomplete" multiple>';

        foreach ($options as $tag) {
            $html .= sprintf(
                '<option value="%s" %s>%s</option>',
                $this->helper->text->e($tag),
                in_array($tag, $tags) ? 'selected="selected"' : '',
                $this->helper->text->e($tag)
            );
        }

        $html .= '</select>';

        return $html;
    }
    
    public function renderActorField(array $project, array $actors = array())
    {
        $options = $this->actorModel->getAssignableList($project['id']);
        
        $html = $this->helper->form->label(t('Actor'), 'actors[]');
        $html .= '<input type="hidden" name="actors[]" value="">';
        $html .= '<select name="actors[]" id="form-actors" class="tag-autocomplete" multiple required>';
        
        foreach ($options as $actor) {
            $html .= sprintf(
                '<option value="%s" %s>%s</option>',
                $this->helper->text->e($actor),
                in_array($actor, $actors) ? 'selected="selected"' : '',
                $this->helper->text->e($actor)
            );
        }
        
        $html .= '</select>';
        
        return $html;
    }
    
    public function multipleActorsNameToString(array $actors)
    {
        $actors_name = "";
        $actors_count = count($actors);
        
        for ($i = 0; $i < $actors_count - 1; $i++)
        {
            $actors_name = $actors_name.$actors[$i]['name'].", ";
        }
        
        $actors_name = $actors_name.$actors[$actors_count-1]['name'];
        
        return $actors_name;
    }

    public function renderColorField(array $values)
    {
        $colors = $this->colorModel->getList();
        $html = $this->helper->form->label(t('Color'), 'color_id');
        $html .= $this->helper->form->select('color_id', $colors, $values, array(), array(), 'color-picker');
        return $html;
    }

    public function renderAssigneeField(array $users, array $values, array $errors = array(), array $attributes = array())
    {
        if (isset($values['project_id']) && ! $this->helper->projectRole->canChangeAssignee($values)) {
            return '';
        }

        $attributes = array_merge(array('tabindex="3"'), $attributes);

        $html = $this->helper->form->label(t('Assignee'), 'owner_id');
        $html .= $this->helper->form->select('owner_id', $users, $values, $errors, $attributes);
        $html .= '&nbsp;';
        $html .= '<small>';
        $html .= '<a href="#" class="assign-me" data-target-id="form-owner_id" data-current-id="'.$this->userSession->getId().'" title="'.t('Assign to me').'">'.t('Me').'</a>';
        $html .= '</small>';

        return $html;
    }

    public function renderCategoryField(array $categories, array $values, array $errors = array(), array $attributes = array(), $allow_one_item = false)
    {
        $attributes = array_merge(array('tabindex="4"'), $attributes);
        $html = '';

        if (! (! $allow_one_item && count($categories) === 1 && key($categories) == 0)) {
            $html .= $this->helper->form->label(t('Category'), 'category_id');
            $html .= $this->helper->form->select('category_id', $categories, $values, $errors, $attributes);
        }

        return $html;
    }

    public function renderSwimlaneField(array $swimlanes, array $values, array $errors = array(), array $attributes = array())
    {
        $attributes = array_merge(array('tabindex="5"'), $attributes);
        $html = '';

        if (count($swimlanes) > 1) {
            $html .= $this->helper->form->label(t('Swimlane'), 'swimlane_id');
            $html .= $this->helper->form->select('swimlane_id', $swimlanes, $values, $errors, $attributes);
        }

        return $html;
    }

    public function renderColumnField(array $columns, array $values, array $errors = array(), array $attributes = array())
    {
        $attributes = array_merge(array('tabindex="6"'), $attributes);

        $html = $this->helper->form->label(t('Column'), 'column_id');
        $html .= $this->helper->form->select('column_id', $columns, $values, $errors, $attributes);

        return $html;
    }

    public function renderPriorityField(array $project, array $values)
    {
        $range = range($project['priority_start'], $project['priority_end']);
        $options = array_combine($range, $range);
        $values += array('priority' => $project['priority_default']);

        $html = $this->helper->form->label(t('Priority'), 'priority');
        $html .= $this->helper->form->select('priority', $options, $values, array(), array('tabindex="7"'));

        return $html;
    }

    public function renderScoreField(array $values, array $errors = array(), array $attributes = array())
    {
        $attributes = array_merge(array('tabindex="13"'), $attributes);

        $html = $this->helper->form->label(t('Complexity'), 'score');
        $html .= $this->helper->form->number('score', $values, $errors, $attributes);

        return $html;
    }

    public function renderReferenceField(array $values, array $errors = array(), array $attributes = array())
    {
        $attributes = array_merge(array('tabindex="14"'), $attributes);

        $html = $this->helper->form->label(t('Reference'), 'reference');
        $html .= $this->helper->form->text('reference', $values, $errors, $attributes, 'form-input-small');

        return $html;
    }

    public function renderTimeEstimatedField(array $values, array $errors = array(), array $attributes = array())
    {
        $attributes = array_merge(array('tabindex="11"'), $attributes);

        $html = $this->helper->form->label(t('Original estimate'), 'time_estimated');
        $html .= $this->helper->form->numeric('time_estimated', $values, $errors, $attributes);
        $html .= ' '.t('hours');

        return $html;
    }

    public function renderTimeSpentField(array $values, array $errors = array(), array $attributes = array())
    {
        $attributes = array_merge(array('tabindex="12"'), $attributes);

        $html = $this->helper->form->label(t('Time spent'), 'time_spent');
        $html .= $this->helper->form->numeric('time_spent', $values, $errors, $attributes);
        $html .= ' '.t('hours');

        return $html;
    }

    public function renderStartDateField(array $values, array $errors = array(), array $attributes = array())
    {
        $attributes = array_merge(array('tabindex="10"'), $attributes);
        return $this->helper->form->datetime(t('Start Date'), 'date_started', $values, $errors, $attributes);
    }

    public function renderDueDateField(array $values, array $errors = array(), array $attributes = array())
    {
        $attributes = array_merge(array('tabindex="9"'), $attributes);
        return $this->helper->form->datetime(t('Due Date'), 'date_due', $values, $errors, $attributes);
    }

    public function renderPriority($priority)
    {
        $html = '<span class="task-priority" title="'.t('Task priority').'">';
        $html .= $this->helper->text->e($priority >= 0 ? 'P'.$priority : '-P'.abs($priority));
        $html .= '</span>';

        return $html;
    }

    public function getProgress($task)
    {
        if (! isset($this->columns[$task['project_id']])) {
            $this->columns[$task['project_id']] = $this->columnModel->getList($task['project_id']);
        }

        return $this->taskModel->getProgress($task, $this->columns[$task['project_id']]);
    }

    public function getNewTaskDropdown($projectId, $swimlaneId, $columnId)
    {
        $providers = $this->externalTaskManager->getProvidersList();

        if (empty($providers)) {
            return '';
        }

        $html = '<small class="pull-right"><div class="dropdown">';
        $html .= '<a href="#" class="dropdown-menu"><i class="fa fa-cloud-download" aria-hidden="true"></i> <i class="fa fa-caret-down"></i></a><ul>';

        foreach ($providers as $providerName) {
            $link = $this->helper->url->link(
                t('New External Task: %s', $providerName),
                'ExternalTaskCreationController',
                'step1',
                array('project_id' => $projectId, 'swimlane_id' => $swimlaneId, 'column_id' => $columnId, 'provider_name' => $providerName),
                false,
                'js-modal-replace'
            );

            $html .= '<li><i class="fa fa-fw fa-plus-square" aria-hidden="true"></i> '.$link.'</li>';
        }

        $html .= '</ul></div></small>';
        return $html;
    }
}
