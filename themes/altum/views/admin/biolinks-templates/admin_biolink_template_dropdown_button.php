<?php defined('ALTUMCODE') || die() ?>

<div class="dropdown">
    <button type="button" class="btn btn-link text-secondary dropdown-toggle dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport">
        <i class="fa fa-fw fa-ellipsis-v"></i>
    </button>

    <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="admin/biolink-template-update/<?= $data->id ?>"><i class="fa fa-fw fa-sm fa-pencil-alt mr-2"></i> <?= l('global.edit') ?></a>
        <a href="#" data-toggle="modal" data-target="#biolink_template_delete_modal" data-biolink-template-id="<?= $data->id ?>" data-resource-name="<?= $data->resource_name ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-trash-alt mr-2"></i> <?= l('global.delete') ?></a>
    </div>
</div>

<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/universal_delete_modal_url.php', [
    'name' => 'biolink_template',
    'resource_id' => 'biolink_template_id',
    'has_dynamic_resource_name' => true,
    'path' => 'admin/biolinks-templates/delete/'
]), 'modals', 'biolink_template_delete_modal'); ?>
