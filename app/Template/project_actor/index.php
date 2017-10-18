<div class="page-header">
    <h2><?= t('Project actors') ?></h2>
    <ul>
        <li>
            <?= $this->modal->medium('plus', t('Add new actor'), 'ProjectActorController', 'create', array('project_id' => $project['id'])) ?>
        </li>
    </ul>
</div>

<?php if (empty($actors)): ?>
    <p class="alert"><?= t('There is no specific actor for this project at the moment.') ?></p>
<?php else: ?>
    <table class="table-striped table-scrolling">
        <tr>
            <th><?= t('Actor') ?></th>
        </tr>
        <?php foreach ($actors as $actor): ?>
            <tr>
                <td>
                    <div class="dropdown">
                        <a href="#" class="dropdown-menu dropdown-menu-link-icon"><i class="fa fa-cog"></i><i class="fa fa-caret-down"></i></a>
                        <ul>
                            <li>
                                <?= $this->modal->medium('edit', t('Edit'), 'ProjectActorController', 'edit', array('actor_id' => $actor['id'], 'project_id' => $project['id'])) ?>
                            </li>
                            <li>
                                <?= $this->modal->confirm('trash-o', t('Remove'), 'ProjectActorController', 'confirm', array('actor_id' => $actor['id'], 'project_id' => $project['id'])) ?>
                            </li>
                        </ul>
                    </div>
                    <?= $this->text->e($actor['name']) ?>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php endif ?>
