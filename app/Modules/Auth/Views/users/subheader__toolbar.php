<?php if (user_can('create')): ?>
    <a href="<?php _url("{$module_base}createForm"); ?>" class="btn btn-label-brand btn-bold">
        <i class=" fa fa-plus"></i>
        <?= lang('btn_add_caption'); ?>
    </a>
<?php endif; ?>