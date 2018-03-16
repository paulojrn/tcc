<section class="accordion-section <?= empty($task['alternative_flow']) ? 'accordion-collapsed' : '' ?>">
    <div class="accordion-title">
        <h3><a href="#" class="fa accordion-toggle"></a> <?= t('Alternative flow') ?></h3>
    </div>
    <div class="accordion-content">
        <article class="markdown">
            <?= $this->text->markdown($task['alternative_flow'], isset($is_public) && $is_public) ?>
        </article>
    </div>
</section>
