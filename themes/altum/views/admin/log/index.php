<?php defined('ALTUMCODE') || die() ?>

<nav aria-label="breadcrumb">
    <ol class="custom-breadcrumbs small">
        <li>
            <a href="<?= url('admin/logs') ?>"><?= l('admin_logs.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
        </li>
        <li class="active" aria-current="page"><?= l('admin_log.breadcrumb') ?></li>
    </ol>
</nav>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 mb-0 text-truncate"><i class="fa fa-fw fa-xs fa-clipboard-list text-primary-900 mr-2"></i> <?= sprintf(l('admin_log.header'), $data->log->name) ?></h1>

    <div class="d-flex align-items-center">
        <div>
            <span class="badge badge-light" data-toggle="tooltip" title="<?= l('admin_logs.main.size') ?>">
                <?= get_formatted_bytes($data->log->size) ?>
            </span>
        </div>

        <div class="ml-3">
            <span class="badge badge-info" data-toggle="tooltip" title="<?= l('admin_logs.main.last_modified') ?>">
                <?= \Altum\Date::get_timeago($data->log->last_modified) ?>
            </span>
        </div>

        <div class="ml-3">
            <?= include_view(THEME_PATH . 'views/admin/logs/admin_log_dropdown_button.php', ['id' => $data->log->name, 'resource_name' => $data->log->name]) ?>
        </div>
    </div>
</div>


<?= \Altum\Alerts::output_alerts() ?>

<div class="card">
    <div class="card-body">
        <?php while(!$data->log->content->eof()): ?>
            <?= e($data->log->content->fgets()) . '<br /><br />' ?>
        <?php endwhile ?>
    </div>
</div>

