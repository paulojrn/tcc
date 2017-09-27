<div class="page-header">
    <h2><?= t('Edit a actor') ?></h2>
</div>
<form method="post" action="<?= $this->url->href('ProjectActorController', 'update', array('actor_id' => $actor['id'], 'project_id' => $project['id'])) ?>" autocomplete="off">
    <?= $this->form->csrf() ?>
    <?= $this->form->hidden('id', $values) ?>
    <?= $this->form->hidden('project_id', $values) ?>

    <?= $this->form->label(t('Name'), 'name') ?>
    <?= $this->form->text('name', $values, $errors, array('autofocus', 'required', 'maxlength="255"')) ?>

    <?= $this->modal->submitButtons() ?>
</form>
