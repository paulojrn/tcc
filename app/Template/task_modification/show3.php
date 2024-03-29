<div class="page-header">
    <h2><?= $this->text->e($project['name']) ?> &gt; <?= $this->text->e($task['title']) ?></h2>
</div>
<form method="post" action="<?= $this->url->href('TaskModificationController', 'update', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>
    <?= $this->form->hidden('id', $values) ?>
    <?= $this->form->hidden('project_id', $values) ?>

    <div class="task-form-container">
        <div class="task-form-main-column">
            <?= $this->task->renderTitleField($values, $errors) ?>
            
            <fieldset>
            <legend><b>Selected stories</b></legend>
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
            			<textarea name="stories" placeholder="Write your text in Markdown"><?= $values['stories'] ?></textarea>
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
            			<textarea name="basic_flow" placeholder="Write your text in Markdown"><?= $values['basic_flow'] ?></textarea>
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
            			<textarea name="alternative_flow" placeholder="Write your text in Markdown"><?= $values['alternative_flow'] ?></textarea>
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
            			<textarea name="exception_flow" placeholder="Write your text in Markdown"><?= $values['exception_flow'] ?></textarea>
            		</div>
                </div>
            </fieldset>
            <fieldset>
            <legend><b>Test cases</b></legend>
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
            			<textarea name="test_cases" placeholder="Write your text in Markdown"><?= $values['test_cases'] ?></textarea>
            		</div>
                 </div>
            </fieldset> 
                        
            <?= $this->task->renderTagField($project, $tags) ?>           

            <?= $this->hook->render('template:task:form:first-column', array('values' => $values, 'errors' => $errors)) ?>
        </div>

        <div class="task-form-secondary-column">
            <?= $this->task->renderAssigneeField($users_list, $values, $errors) ?>
            <?= $this->task->renderCategoryField($categories_list, $values, $errors) ?>
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
            <?= $this->modal->submitButtons() ?>            
        </div>
    </div>
</form>
