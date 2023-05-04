<?php defined('ALTUMCODE') || die() ?>

<div class="form-group">
    <label for="cron"><?= l('admin_settings.cron.cron') ?></label>
    <div class="input-group">
        <input id="cron" name="cron" type="text" class="form-control" value="<?= '* * * * * wget --quiet -O /dev/null ' . SITE_URL . 'cron?key=' . settings()->cron->key ?>" readonly="readonly" />
        <div class="input-group-append">
            <span class="input-group-text" data-toggle="tooltip" title="<?= sprintf(l('admin_settings.cron.last_execution'), isset(settings()->cron->cron_datetime) ? \Altum\Date::get_timeago(settings()->cron->cron_datetime) : '-') ?>">
                <i class="fa fa-fw fa-calendar text-muted"></i>
            </span>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="cron_broadcasts"><?= l('admin_settings.cron.broadcasts') ?></label>
    <div class="input-group">
        <input id="cron_broadcasts" name="cron_broadcasts" type="text" class="form-control" value="<?= '* * * * * wget --quiet -O /dev/null ' . SITE_URL . 'cron/broadcasts?key=' . settings()->cron->key ?>" readonly="readonly" />
        <div class="input-group-append">
            <span class="input-group-text" data-toggle="tooltip" title="<?= sprintf(l('admin_settings.cron.last_execution'), isset(settings()->cron->broadcasts_datetime) ? \Altum\Date::get_timeago(settings()->cron->broadcasts_datetime) : '-') ?>">
                <i class="fa fa-fw fa-calendar text-muted"></i>
            </span>
        </div>
    </div>
</div>
