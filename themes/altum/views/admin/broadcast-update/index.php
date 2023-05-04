<?php defined('ALTUMCODE') || die() ?>

<nav aria-label="breadcrumb">
    <ol class="custom-breadcrumbs small">
        <li>
            <a href="<?= url('admin/broadcasts') ?>"><?= l('admin_broadcasts.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
        </li>
        <li class="active" aria-current="page"><?= l('admin_broadcast_update.breadcrumb') ?></li>
    </ol>
</nav>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 mb-0 text-truncate"><i class="fa fa-fw fa-xs fa-mail-bulk text-primary-900 mr-2"></i> <?= l('admin_broadcast_update.header') ?></h1>

    <?= include_view(THEME_PATH . 'views/admin/broadcasts/admin_broadcast_dropdown_button.php', ['id' => $data->broadcast->broadcast_id, 'resource_name' => $data->broadcast->name]) ?>
</div>

<?= \Altum\Alerts::output_alerts() ?>

<div class="card <?= \Altum\Alerts::has_field_errors() ? 'border-danger' : null ?>">
    <div class="card-body">

        <form action="" method="post" role="form">
            <input type="hidden" name="token" value="<?= \Altum\Csrf::get() ?>" />

            <div class="form-group">
                <label for="name"><i class="fa fa-fw fa-sm fa-signature text-muted mr-1"></i> <?= l('global.name') ?></label>
                <input type="text" id="name" name="name" value="<?= $data->broadcast->name ?>" class="form-control <?= \Altum\Alerts::has_field_errors('name') ? 'is-invalid' : null ?>" maxlength="64" required="required" />
                <?= \Altum\Alerts::output_field_error('name') ?>
                <small class="form-text text-muted"><?= l('admin_broadcasts.main.name_help') ?></small>
            </div>

            <div class="form-group">
                <label for="subject"><i class="fa fa-fw fa-sm fa-heading text-muted mr-1"></i> <?= l('admin_broadcasts.main.subject') ?></label>
                <input type="text" id="subject" name="subject" value="<?= $data->broadcast->subject ?>" class="form-control <?= \Altum\Alerts::has_field_errors('subject') ? 'is-invalid' : null ?>" maxlength="128" required="required" <?= $data->broadcast->status == 'sent' ? 'readonly="readonly"' : null ?> />
                <?= \Altum\Alerts::output_field_error('subject') ?>
                <small class="form-text text-muted"><?= l('admin_broadcasts.main.subject_help') ?></small>
                <small class="form-text text-muted"><?= l('admin_broadcasts.main.variables') ?></small>
            </div>

            <div class="form-group">
                <label for="segment"><i class="fa fa-fw fa-sm fa-layer-group text-muted mr-1"></i> <?= l('admin_broadcasts.main.segment') ?></label>
                <select id="segment" name="segment" class="form-control <?= \Altum\Alerts::has_field_errors('segment') ? 'is-invalid' : null ?>" required="required" <?= $data->broadcast->status == 'sent' ? 'readonly="readonly"' : null ?>>
                    <option value="all" <?= $data->broadcast->segment == 'all' ? 'selected="selected"' : null ?>><?= l('admin_broadcasts.main.segment.all') . ' (' . nr($data->segment_all) . ')' ?></option>
                    <option value="subscribers" <?= $data->broadcast->segment == 'subscribers' ? 'selected="selected"' : null ?>><?= l('admin_broadcasts.main.segment.subscribers') . ' (' . nr($data->segment_subscribers) . ')' ?></option>
                    <option value="custom" <?= $data->broadcast->segment == 'custom' ? 'selected="selected"' : null ?>><?= l('admin_broadcasts.main.segment.custom') ?></option>
                </select>
                <?= \Altum\Alerts::output_field_error('segment') ?>
                <small class="form-text text-muted"><?= l('admin_broadcasts.main.segment_help') ?></small>
                <small class="form-text text-muted"><?= l('admin_broadcasts.main.segment_help2') ?></small>
            </div>

            <div class="form-group" data-segment="custom">
                <label for="users_ids"><i class="fa fa-fw fa-sm fa-users text-muted mr-1"></i> <?= l('admin_broadcasts.main.users_ids') ?></label>
                <input type="text" id="users_ids" name="users_ids" value="<?= $data->broadcast->users_ids ?>" class="form-control <?= \Altum\Alerts::has_field_errors('users_ids') ? 'is-invalid' : null ?>" placeholder="<?= l('admin_broadcasts.main.users_ids_placeholder') ?>" required="required" <?= $data->broadcast->status == 'sent' ? 'readonly="readonly"' : null ?> />
                <?= \Altum\Alerts::output_field_error('users_ids') ?>
                <small class="form-text text-muted"><?= l('admin_broadcasts.main.users_ids_help') ?></small>
            </div>

            <div class="form-group">
                <label for="content"><i class="fa fa-fw fa-sm fa-paragraph text-muted mr-1"></i> <?= l('admin_broadcasts.main.content') ?></label>
                <div id="quill_container" class="<?= $data->broadcast->status == 'sent' ? 'container-disabled' : null ?>">
                    <div id="quill"></div>
                </div>
                <textarea name="content" id="content" class="form-control d-none" style="height: 15rem;"><?= $data->broadcast->content ?></textarea>
                <small class="form-text text-muted"><?= l('admin_broadcasts.main.variables') ?></small>
            </div>

            <div class="alert alert-info" role="alert"><?= l('admin_broadcast_create.info1') ?></div>
            <div class="alert alert-info" role="alert"><?= l('admin_broadcast_create.info2') ?></div>
            <div class="alert alert-info" role="alert"><?= l('admin_broadcast_create.info3') ?></div>

            <div class="form-group">
                <div class="input-group">
                    <input type="email" id="preview_email" name="preview_email" value="<?= $this->user->email ?>" class="form-control <?= \Altum\Alerts::has_field_errors('preview_email') ? 'is-invalid' : null ?>" placeholder="<?= l('global.email_placeholder') ?>" />
                    <div class="input-group-append">
                        <button type="submit" name="preview" class="btn btn-light"><?= l('admin_broadcast_create.send_preview') ?></button>
                    </div>
                </div>
                <?= \Altum\Alerts::output_field_error('preview_email') ?>
            </div>

            <?php if($data->broadcast->status == 'sent'): ?>
                <button type="submit" name="save" class="btn btn-block btn-outline-primary mt-3"><?= l('global.update') ?></button>
            <?php else: ?>
                <button type="submit" name="save" class="btn btn-block btn-outline-primary mt-3"><?= l('admin_broadcast_create.save_draft') ?></button>
                <button type="submit" name="send" class="btn btn-lg btn-block btn-primary mt-3"><?= l('admin_broadcast_create.send_broadcast') ?></button>
            <?php endif ?>
        </form>

    </div>
</div>

<?php ob_start() ?>
<link href="<?= ASSETS_FULL_URL . 'css/libraries/quill.snow.css?v=' . PRODUCT_CODE ?>" rel="stylesheet" media="screen,print">
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<?php ob_start() ?>
<script src="<?= ASSETS_FULL_URL . 'js/libraries/quill.min.js' ?>"></script>

<script>
    'use strict';

    let quill = new Quill('#quill', {
        theme: 'snow',
        modules: {
            toolbar: [
                ["bold", "italic", "underline", "strike"],
                [{ "header": 1 }, { "header": 2 }],
                ["blockquote", "code-block"],
                [{ "list": "ordered" }, { "list": "bullet" }, { "indent": "-1" }, { "indent": "+1" }],
                [{ "direction": "rtl" }, { "align": "" }, { "align": "center" }, { "align": "right" }, { "align": "justify" }],
                [{ "script": "sub" }, { "script": "super" }],
                ["link", "clean"]
            ]
        },
    });

    quill.root.innerHTML = document.querySelector('#content').value;
    quill.enable(true);
    document.querySelector('#quill_container').classList.remove('d-none');
    document.querySelector('#content').classList.add('d-none');

    <?php if($data->broadcast->status == 'sent'): ?>
    quill.disable();
    <?php endif ?>

    /* Handle form submission with the editor */
    document.querySelector('form').addEventListener('submit', event => {
        document.querySelector('#content').value = quill.root.innerHTML;
    });

</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>

<?php ob_start() ?>
<script>
    'use strict';

    type_handler('[name="segment"]', 'data-segment');
    document.querySelector('[name="segment"]') && document.querySelectorAll('[name="segment"]').forEach(element => element.addEventListener('change', () => { type_handler('[name="segment"]', 'data-segment'); }));
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
