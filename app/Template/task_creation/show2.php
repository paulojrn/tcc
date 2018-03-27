<div class="page-header">
    <h2><?= $this->text->e($project['name']) ?> &gt; <?= t('New use case') ?><?= $this->task->getNewTaskDropdown($project['id'], $values['swimlane_id'], $values['column_id']) ?></h2>
</div>
<form method="post" action="<?= $this->url->href('TaskCreationController', 'save2', array('project_id' => $project['id'])) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>
    <?= $this->form->hidden('project_id', $values) ?>

    <div class="task-form-container">
        <div class="task-form-main-column">
            <?= $this->task->renderTitleField($values, $errors) ?>
            
            <fieldset>
            <legend><b>Stories</b></legend>
                <div class="text-editor">
                	<div class="text-editor-view-mode" style="display: none;">
                		<div class="text-editor-toolbar">
                			<a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Write</a>
                		</div>
                		<div class="text-editor-preview-area markdown"></div>
                	</div>
            		<div class="text-editor-write-mode">
            			<div class="text-editor-toolbar">
            				<a href="#"><i class="fa fa-eye fa-fw"></i> Preview</a>
            				<a href="#"><i class="fa fa-bold fa-fw"></i></a>
            				<a href="#"><i class="fa fa-italic fa-fw"></i></a>
            				<a href="#"><i class="fa fa-strikethrough fa-fw"></i></a>
            				<a href="#"><i class="fa fa-quote-right fa-fw"></i></a>
            				<a href="#"><i class="fa fa-list-ul fa-fw"></i></a>
            				<a href="#"><i class="fa fa-code fa-fw"></i></a>
            			</div>
            			<textarea name="stories" placeholder="Write your text in Markdown"></textarea>
            		</div>
                 </div>
            </fieldset>
            <fieldset>
            <legend><b>Flows</b></legend>
                <div class="text-editor">
                	<div class="text-editor-view-mode" style="display: none;">
                		<div class="text-editor-toolbar">
                			<a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Write</a>
                		</div>
                		<div class="text-editor-preview-area markdown"></div>
                	</div>
            		<div class="text-editor-write-mode">
            			<div class="text-editor-toolbar">
            				<p>Basic</p>
            				<a href="#"><i class="fa fa-eye fa-fw"></i> Preview</a>
            				<a href="#"><i class="fa fa-bold fa-fw"></i></a>
            				<a href="#"><i class="fa fa-italic fa-fw"></i></a>
            				<a href="#"><i class="fa fa-strikethrough fa-fw"></i></a>
            				<a href="#"><i class="fa fa-quote-right fa-fw"></i></a>
            				<a href="#"><i class="fa fa-list-ul fa-fw"></i></a>
            				<a href="#"><i class="fa fa-code fa-fw"></i></a>
            			</div>
            			<textarea name="basic_flow" placeholder="Write your text in Markdown"></textarea>
            		</div>
                </div>
                
                <div class="text-editor">
                	<div class="text-editor-view-mode" style="display: none;">
                		<div class="text-editor-toolbar">
                			<a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Write</a>
                		</div>
                		<div class="text-editor-preview-area markdown"></div>
                	</div>
            		<div class="text-editor-write-mode">
            			<div class="text-editor-toolbar">
            				<p>Alternative</p>
            				<a href="#"><i class="fa fa-eye fa-fw"></i> Preview</a>
            				<a href="#"><i class="fa fa-bold fa-fw"></i></a>
            				<a href="#"><i class="fa fa-italic fa-fw"></i></a>
            				<a href="#"><i class="fa fa-strikethrough fa-fw"></i></a>
            				<a href="#"><i class="fa fa-quote-right fa-fw"></i></a>
            				<a href="#"><i class="fa fa-list-ul fa-fw"></i></a>
            				<a href="#"><i class="fa fa-code fa-fw"></i></a>
            			</div>
            			<textarea name="alternative_flow" placeholder="Write your text in Markdown"></textarea>
            		</div>
                </div>
                
                <div class="text-editor">
                	<div class="text-editor-view-mode" style="display: none;">
                		<div class="text-editor-toolbar">
                			<a href="#"><i class="fa fa-pencil-square-o fa-fw"></i> Write</a>
                		</div>
                		<div class="text-editor-preview-area markdown"></div>
                	</div>
            		<div class="text-editor-write-mode">
            			<div class="text-editor-toolbar">
            				<p>Exception</p>
            				<a href="#"><i class="fa fa-eye fa-fw"></i> Preview</a>
            				<a href="#"><i class="fa fa-bold fa-fw"></i></a>
            				<a href="#"><i class="fa fa-italic fa-fw"></i></a>
            				<a href="#"><i class="fa fa-strikethrough fa-fw"></i></a>
            				<a href="#"><i class="fa fa-quote-right fa-fw"></i></a>
            				<a href="#"><i class="fa fa-list-ul fa-fw"></i></a>
            				<a href="#"><i class="fa fa-code fa-fw"></i></a>
            			</div>
            			<textarea name="exception_flow" placeholder="Write your text in Markdown"></textarea>
            		</div>
                </div>
            </fieldset>
                                    
            <?= $this->task->renderTagField($project) ?>
            <?= $this->task->renderActorField($project) ?><span class="form-required">*</span>

            <?php if ($errors["use_case"]):?>
            <ul class="form-errors">
            	<li>
            		<p>At least one actor is required</p>
            	</li>
            </ul>
            <?php endif ?>

            <?= $this->hook->render('template:task:form:first-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <div class="task-form-secondary-column">
            <?= $this->task->renderAssigneeField($users_list, $values, $errors) ?>
            <?= $this->task->renderSwimlaneField($swimlanes_list, $values, $errors) ?>
            <?= $this->task->renderPriorityField($project, $values) ?>

            <?= $this->hook->render('template:task:form:second-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <div class="task-form-secondary-column">
            <?= $this->task->renderDueDateField($values, $errors) ?>
            <?= $this->task->renderStartDateField($values, $errors) ?>
            <?= $this->task->renderTimeEstimatedField($values, $errors) ?>
            <?= $this->task->renderTimeSpentField($values, $errors) ?>
            <?= $this->task->renderScoreField($values, $errors) ?>
            <?= $this->task->renderReferenceField($values, $errors) ?>

            <?= $this->hook->render('template:task:form:third-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <div class="task-form-bottom">
            <?php if (! isset($duplicate)): ?>
                <?= $this->form->checkbox('duplicate_multiple_projects', t('Duplicate to multiple projects'), 1) ?>
            <?php endif ?>

            <?= $this->modal->submitButtons() ?>
        </div>
    </div>
</form>
