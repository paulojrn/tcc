<div class="page-header">
    <h2><?= t('Remove a actor') ?></h2>
</div>

<div class="confirm">
    <p class="alert alert-info">
        <?= t('Do you really want to remove this actor: "%s"?', $actor['name']) ?>
    </p>

    <?= $this->modal->confirmButtons(
        'ProjectActorController',
        'remove',
        array('actor_id' => $actor['id'], 'project_id' => $project['id'])
    ) ?>
</div>
