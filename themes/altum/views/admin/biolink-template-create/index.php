<?php defined('ALTUMCODE') || die() ?>

<nav aria-label="breadcrumb">
    <ol class="custom-breadcrumbs small">
        <li>
            <a href="<?= url('admin/biolinks-templates') ?>"><?= l('admin_biolinks_templates.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
        </li>
        <li class="active" aria-current="page"><?= l('admin_biolink_template_create.breadcrumb') ?></li>
    </ol>
</nav>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 mb-0 mr-1"><i class="fa fa-fw fa-xs fa-moon text-primary-900 mr-2"></i> <?= l('admin_biolink_template_create.header') ?></h1>
</div>

<?= \Altum\Alerts::output_alerts() ?>

<div class="card <?= \Altum\Alerts::has_field_errors() ? 'border-danger' : null ?>">
    <div class="card-body">

        <form action="" method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />

            <div class="form-group">
                <label for="name"><i class="fa fa-fw fa-sm fa-signature text-muted mr-1"></i> <?= l('global.name') ?></label>
                <input type="text" id="name" name="name" value="<?= $data->values['name'] ?>" class="form-control" required="required" />
            </div>

            <div class="form-group">
                <label for="link_id"><i class="fa fa-fw fa-sm fa-hashtag text-muted mr-1"></i> <?= l('admin_biolinks_templates.main.link_id') ?></label>
                <input id="link_id" type="number" name="link_id" value="<?= $data->values['link_id'] ?>" class="form-control" />
                <small class="form-text text-muted"><?= l('admin_biolinks_templates.main.link_id_help') ?></small>
            </div>

            <div class="form-group">
                <label for="url"><i class="fa fa-fw fa-sm fa-link text-muted mr-1"></i> <?= l('admin_biolinks_templates.main.url') ?></label>
                <input id="url" type="url" name="url" value="<?= $data->values['url'] ?>" class="form-control" />
                <small class="form-text text-muted"><?= l('admin_biolinks_templates.main.url_help') ?></small>
            </div>

            <div class="form-group">
                <label for="image"><i class="fa fa-fw fa-sm fa-image text-muted mr-1"></i> <?= l('admin_biolinks_templates.main.image') ?></label>
                <input id="image" type="file" name="image" accept="<?= \Altum\Uploads::get_whitelisted_file_extensions_accept('biolinks_templates') ?>" class="form-control-file altum-file-input" />
                <small class="form-text text-muted"><?= sprintf(l('global.accessibility.whitelisted_file_extensions'), \Altum\Uploads::get_whitelisted_file_extensions_accept('biolinks_templates')) . ' ' . sprintf(l('global.accessibility.file_size_limit'), get_max_upload()) ?></small>
            </div>

            <div class="form-group">
                <label for="order"><i class="fa fa-fw fa-sm fa-sort text-muted mr-1"></i> <?= l('global.order') ?></label>
                <input id="order" type="number" name="order" value="<?= $data->values['order'] ?>" class="form-control" />
            </div>

            <div class="form-group custom-control custom-switch">
                <input id="is_enabled" name="is_enabled" type="checkbox" class="custom-control-input" <?= $data->values['is_enabled'] ? 'checked="checked"' : null ?>">
                <label class="custom-control-label" for="is_enabled"><i class="fa fa-fw fa-sm fa-dot-circle text-muted mr-1"></i> <?= l('global.status') ?></label>
            </div>

            <button type="submit" name="submit" class="btn btn-lg btn-block btn-primary mt-4"><?= l('global.create') ?></button>
        </form>

    </div>
</div>
