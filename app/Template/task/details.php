<section id="task-summary">
    <h2><?= $this->text->e($task['title']) ?></h2>

    <?= $this->hook->render('template:task:details:top', array('task' => $task)) ?>

    <div class="task-summary-container color-<?= $task['color_id'] ?>">
        <div class="task-summary-columns">
            <div class="task-summary-column">
                <ul class="no-bullet">
                    <li>
                        <strong><?= t('Status:') ?></strong>
                        <span>
                        <?php if ($task['is_active'] == 1): ?>
                            <?= t('open') ?>
                        <?php else: ?>
                            <?= t('closed') ?>
                        <?php endif ?>
                        </span>
                    </li>
                    <li>
                        <strong><?= t('Priority:') ?></strong> <span><?= $task['priority'] ?></span>
                    </li>
                    <?php if (! empty($task['reference'])): ?>
                        <li>
                            <strong><?= t('Reference:') ?></strong> <span><?= $this->text->e($task['reference']) ?></span>
                        </li>
                    <?php endif ?>
                    <?php if (! empty($task['score'])): ?>
                        <li>
                            <strong><?= t('Complexity:') ?></strong> <span><?= $this->text->e($task['score']) ?></span>
                        </li>
                    <?php endif ?>
                    <?php if ($project['is_public']): ?>
                    <li>
                        <small>
                            <?= $this->url->icon('external-link', t('Public link'), 'TaskViewController', 'readonly', array('task_id' => $task['id'], 'token' => $project['token']), false, '', '', true) ?>
                        </small>
                    </li>
                    <?php endif ?>
                    <?php if ($project['is_public'] && !$editable): ?>
                    <li>
                        <small>
                            <?= $this->url->icon('th', t('Back to the board'), 'BoardViewController', 'readonly', array('token' => $project['token'])) ?>
                        </small>
                    </li>
                    <?php endif ?>

                    <?= $this->hook->render('template:task:details:first-column', array('task' => $task)) ?>
                </ul>
            </div>
            <div class="task-summary-column">
                <ul class="no-bullet">
                    <?php if (! empty($task['category_name'])): ?>
                        <li>
                            <strong><?= t('Category:') ?></strong>
                            <span><?= $this->text->e($task['category_name']) ?></span>
                        </li>
                    <?php endif ?>
                    <?php if (! empty($task['swimlane_name'])): ?>
                        <li>
                            <strong><?= t('Swimlane:') ?></strong>
                            <span><?= $this->text->e($task['swimlane_name']) ?></span>
                        </li>
                    <?php endif ?>
                    <li>
                    	<?php if ($task['category_id'] == ("1" || "2")): ?>
                    		<strong><?= t('Stage:') ?></strong>
                    		<?php if ($task['category_id'] == "1"): ?>
                    			<span><?= $this->text->e($task['column_title']) ?></span>
                    		<?php else: ?>
                    			<?php if ($task['column_title'] == "Input"): ?>
                    				<span><?= $this->text->e("Scoped") ?></span>
                    			<?php endif ?>
                    			<?php if ($task['column_title'] == "Preparation"): ?>
                    				<span><?= $this->text->e("Prepared") ?></span>
                    			<?php endif ?>
                    			<?php if ($task['column_title'] == "Development"): ?>
                    				<span><?= $this->text->e("Analysed") ?></span>
                    			<?php endif ?>
                    			<?php if ($task['column_title'] == "System test"): ?>
                    				<span><?= $this->text->e("Implemented") ?></span>
                    			<?php endif ?>
                    			<?php if ($task['column_title'] == "Live"): ?>
                    				<span><?= $this->text->e("Verified") ?></span>
                    			<?php endif ?>
                    		<?php endif ?>
                    	<?php else: ?>
                    		<strong><?= t('Column:') ?></strong>
                    		<span><?= $this->text->e($task['column_title']) ?></span>
                    	<?php endif ?>
                        
                    </li>
                    <li>
                        <strong><?= t('Position:') ?></strong>
                        <span><?= $task['position'] ?></span>
                    </li>

                    <?= $this->hook->render('template:task:details:second-column', array('task' => $task)) ?>
                </ul>
            </div>
            <div class="task-summary-column">
                <ul class="no-bullet">
                    <li>
                        <strong><?= t('Assignee:') ?></strong>
                        <span>
                        <?php if ($task['assignee_username']): ?>
                            <?= $this->text->e($task['assignee_name'] ?: $task['assignee_username']) ?>
                        <?php else: ?>
                            <?= t('not assigned') ?>
                        <?php endif ?>
                        </span>
                    </li>
                    <?php if ($task['creator_username']): ?>
                        <li>
                            <strong><?= t('Creator:') ?></strong>
                            <span><?= $this->text->e($task['creator_name'] ?: $task['creator_username']) ?></span>
                        </li>
                    <?php endif ?>
                    <?php if ($task['date_due']): ?>
                    <li>
                        <strong><?= t('Due date:') ?></strong>
                        <span><?= $this->dt->datetime($task['date_due']) ?></span>
                    </li>
                    <?php endif ?>
                    <?php if ($task['time_estimated']): ?>
                    <li>
                        <strong><?= t('Time estimated:') ?></strong>
                        <span><?= t('%s hours', $task['time_estimated']) ?></span>
                    </li>
                    <?php endif ?>
                    <?php if ($task['time_spent']): ?>
                    <li>
                        <strong><?= t('Time spent:') ?></strong>
                        <span><?= t('%s hours', $task['time_spent']) ?></span>
                    </li>
                    <?php endif ?>

                    <?= $this->hook->render('template:task:details:third-column', array('task' => $task)) ?>
                </ul>
            </div>
            <div class="task-summary-column">
                <ul class="no-bullet">
                    <li>
                        <strong><?= t('Created:') ?></strong>
                        <span><?= $this->dt->datetime($task['date_creation']) ?></span>
                    </li>
                    <li>
                        <strong><?= t('Modified:') ?></strong>
                        <span><?= $this->dt->datetime($task['date_modification']) ?></span>
                    </li>
                    <?php if ($task['date_completed']): ?>
                    <li>
                        <strong><?= t('Completed:') ?></strong>
                        <span><?= $this->dt->datetime($task['date_completed']) ?></span>
                    </li>
                    <?php endif ?>
                    <?php if ($task['date_started']): ?>
                    <li>
                        <strong><?= t('Started:') ?></strong>
                        <span><?= $this->dt->datetime($task['date_started']) ?></span>
                    </li>
                    <?php endif ?>
                    <?php if ($task['date_moved']): ?>
                    <li>
                        <strong><?= t('Moved:') ?></strong>
                        <span><?= $this->dt->datetime($task['date_moved']) ?></span>
                    </li>
                    <?php endif ?>

                    <?= $this->hook->render('template:task:details:fourth-column', array('task' => $task)) ?>
                </ul>
            </div>
        </div>
        <?php if (! empty($tags)): ?>
            <div class="task-tags">
                <ul>
                    <?php foreach ($tags as $tag): ?>
                        <li><?= $this->text->e($tag) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
    </div>

    <?php if (! empty($task['external_uri']) && ! empty($task['external_provider'])): ?>
        <?= $this->app->component('external-task-view', array(
            'url' => $this->url->href('ExternalTaskViewController', 'show', array('project_id' => $task['project_id'], 'task_id' => $task['id'])),
        )) ?>
    <?php endif ?>

    <?php if ($editable && empty($task['date_started'])): ?>
        <div class="buttons-header">
            <?= $this->url->button('play', t('Set start date'), 'TaskModificationController', 'start', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
        </div>
    <?php endif ?>

    <?= $this->hook->render('template:task:details:bottom', array('task' => $task)) ?>
</section>
