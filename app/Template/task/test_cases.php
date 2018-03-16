<section class="accordion-section <?= empty($task['test_cases']) ? 'accordion-collapsed' : '' ?>">
    <div class="accordion-title">
        <h3><a href="#" class="fa accordion-toggle"></a> <?= t('Test cases') ?></h3>
    </div>
    <div class="accordion-content">
        <article class="markdown">
            <?= $this->text->markdown($task['test_cases'], isset($is_public) && $is_public) ?>
        </article>
    </div>
</section>
