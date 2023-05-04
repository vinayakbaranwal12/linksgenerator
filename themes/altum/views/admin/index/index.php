<?php defined('ALTUMCODE') || die() ?>

<?php
if(isset(settings()->support->expiry_datetime)):
    $expiry_datetime = (new \DateTime(settings()->support->expiry_datetime ?? null));
    $is_active = (new \DateTime()) <= $expiry_datetime;
    ?>
    <?php if(!$is_active && !isset($_COOKIE['dismiss_inactive_support'])): ?>
    <div class="alert alert-warning">
        <i class="fa fa-fw fa-exclamation-triangle text-warning mr-1"></i>
        <?= sprintf(l('admin_index.support.inactive'), '<a href="https://altumco.de/' . PRODUCT_KEY . '-buy" target="_blank" class="font-weight-bold">', '</a>') ?>
        <button type="button" class="close" data-dismiss="alert" data-dismiss-inactive-support><i class="fa fa-fw fa-sm fa-times text-warning"></i></button>
        <?php ob_start() ?>
        <script>
            'use strict';
            document.querySelector('[data-dismiss-inactive-support]').addEventListener('click', event => {
                set_cookie('dismiss_inactive_support', 1, 7, <?= json_encode(COOKIE_PATH) ?>);
            });
        </script>
        <?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
    </div>
<?php endif ?>
<?php endif ?>

<h1 class="h3 mb-4 text-truncate"><?= sprintf(l('admin_index.header'), $this->user->name) ?></h1>

<div class="mb-5 row justify-content-between">
    <div class="col-12 col-sm-6 col-xl-3 mb-4 position-relative">
        <div class="card d-flex flex-row h-100 overflow-hidden">
            <div class="card-body">
                <small class="text-muted"><i class="fa fa-fw fa-sm fa-hashtag mr-1"></i> <?= l('admin_index.biolink_links') ?></small>

                <div class="mt-3"><span class="h4"><?= nr($data->biolink_links) ?></span></div>
            </div>

            <div class="pr-4 d-flex flex-column justify-content-center">
                <a href="<?= url('admin/links?type=biolink') ?>" class="stretched-link">
                    <i class="fa fa-fw fa-angle-right text-gray-500"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3 mb-4 position-relative">
        <div class="card d-flex flex-row h-100 overflow-hidden">
            <div class="card-body">
                <small class="text-muted"><i class="fa fa-fw fa-sm fa-link mr-1"></i> <?= l('admin_index.shortened_links') ?></small>

                <div class="mt-3"><span class="h4"><?= nr($data->shortened_links) ?></span></div>
            </div>

            <div class="pr-4 d-flex flex-column justify-content-center">
                <a href="<?= url('admin/links?type=link') ?>" class="stretched-link">
                    <i class="fa fa-fw fa-angle-right text-gray-500"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3 mb-4 position-relative">
        <div class="card d-flex flex-row h-100 overflow-hidden">
            <div class="card-body">
                <small class="text-muted"><i class="fa fa-fw fa-sm fa-chart-bar mr-1"></i> <?= l('admin_index.track_links') ?></small>

                <div class="mt-3"><span class="h4"><?= nr($data->track_links) ?></span></div>
            </div>

            <div class="pr-4 d-flex flex-column justify-content-center">
                <a href="<?= url('admin/statistics/track_links') ?>" class="stretched-link">
                    <i class="fa fa-fw fa-angle-right text-gray-500"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3 mb-4 position-relative">
        <div class="card d-flex flex-row h-100 overflow-hidden">
            <div class="card-body">
                <small class="text-muted"><i class="fa fa-fw fa-sm fa-qrcode mr-1"></i> <?= l('admin_qr_codes.menu') ?></small>

                <div class="mt-3"><span class="h4"><?= nr($data->qr_codes) ?></span></div>
            </div>

            <div class="pr-4 d-flex flex-column justify-content-center">
                <a href="<?= url('admin/qr-codes') ?>" class="stretched-link">
                    <i class="fa fa-fw fa-angle-right text-gray-500"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3 mb-4 position-relative">
        <div class="card d-flex flex-row h-100 overflow-hidden">
            <div class="card-body">
                <small class="text-muted"><i class="fa fa-fw fa-sm fa-globe mr-1"></i> <?= l('admin_domains.menu') ?></small>

                <div class="mt-3"><span class="h4"><?= nr($data->domains) ?></span></div>
            </div>

            <div class="pr-4 d-flex flex-column justify-content-center">
                <a href="<?= url('admin/domains') ?>" class="stretched-link">
                    <i class="fa fa-fw fa-angle-right text-gray-500"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3 mb-4 position-relative">
        <div class="card d-flex flex-row h-100 overflow-hidden">
            <div class="card-body">
                <small class="text-muted"><i class="fa fa-fw fa-sm fa-users mr-1"></i> <?= l('admin_users.menu') ?></small>

                <div class="mt-3"><span class="h4"><?= nr($data->users) ?></span></div>
            </div>

            <div class="pr-4 d-flex flex-column justify-content-center">
                <a href="<?= url('admin/users') ?>" class="stretched-link">
                    <i class="fa fa-fw fa-angle-right text-gray-500"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3 mb-4 position-relative">
        <div class="card d-flex flex-row h-100 overflow-hidden">
            <div class="card-body">
                <small class="text-muted"><i class="fa fa-fw fa-sm fa-funnel-dollar mr-1"></i> <?= l('admin_payments.menu') ?></small>

                <div class="mt-3"><span class="h4"><?= nr($data->payments) ?></span></div>
            </div>

            <div class="pr-4 d-flex flex-column justify-content-center">
                <a href="<?= url('admin/payments') ?>" class="stretched-link">
                    <i class="fa fa-fw fa-angle-right text-gray-500"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3 mb-4 position-relative">
        <div class="card d-flex flex-row h-100 overflow-hidden">
            <div class="card-body">
                <small class="text-muted"><i class="fa fa-fw fa-sm fa-dollar-sign mr-1"></i> <?= l('admin_index.payments_total_amount') ?></small>

                <div class="mt-3"><span class="h4"><?= nr($data->payments_total_amount, 2) ?></span> <small><?= settings()->payment->currency ?></small></div>
            </div>

            <div class="pr-4 d-flex flex-column justify-content-center">
                <a href="<?= url('admin/payments') ?>" class="stretched-link">
                    <i class="fa fa-fw fa-angle-right text-gray-500"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="mb-5">
    <h1 class="h3 mb-4"><i class="fa fa-fw fa-xs fa-users text-primary-900 mr-2"></i> <?= l('admin_index.users') ?></h1>

    <?php $result = database()->query("SELECT * FROM `users` ORDER BY `user_id` DESC LIMIT 5"); ?>
    <div class="table-responsive table-custom-container">
        <table class="table table-custom">
            <thead>
            <tr>
                <th><?= l('global.user') ?></th>
                <th><?= l('global.status') ?></th>
                <th><?= l('admin_users.main.plan_id') ?></th>
                <th><?= l('admin_users.table.details') ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_object()): ?>
                <?php //CODE:DEMO if(DEMO) {$row->email = 'hidden@demo.com'; $row->name = 'hidden on demo';} ?>
                <?php if(!isset($data->plans[$row->plan_id])) $data->plans[$row->plan_id] = (new \Altum\Models\Plan())->get_plan_by_id($row->plan_id) ?>
                <tr>
                    <td class="text-nowrap">
                        <div class="d-flex">
                            <a href="<?= url('admin/user-view/' . $row->user_id) ?>">
                                <img src="<?= get_gravatar($row->email) ?>" class="user-avatar rounded-circle mr-3" alt="" />
                            </a>

                            <div class="d-flex flex-column">
                                <div>
                                    <a href="<?= url('admin/user-view/' . $row->user_id) ?>" <?= $row->type == 1 ? 'class="font-weight-bold" data-toggle="tooltip" title="' . l('admin_users.main.type_admin') . '"' : null ?>><?= $row->name ?></a>
                                </div>

                                <span class="text-muted"><?= $row->email ?></span>
                            </div>
                        </div>
                    </td>
                    <td class="text-nowrap">
                        <?php if($row->status == 0): ?>
                            <a href="<?= url('admin/users?status=0') ?>" class="badge badge-warning"><i class="fa fa-fw fa-sm fa-eye-slash mr-1"></i> <?= l('admin_users.main.status_unconfirmed') ?></a>
                        <?php elseif($row->status == 1): ?>
                            <a href="<?= url('admin/users?status=1') ?>" class="badge badge-success"><i class="fa fa-fw fa-sm fa-check mr-1"></i> <?= l('admin_users.main.status_active') ?></a>
                        <?php elseif($row->status == 2): ?>
                            <a href="<?= url('admin/users?status=2') ?>" class="badge badge-light"><i class="fa fa-fw fa-sm fa-times mr-1"></i> <?= l('admin_users.main.status_disabled') ?></a>
                        <?php endif ?>
                    </td>
                    <td class="text-nowrap">
                        <div class="d-flex flex-column">
                            <div>
                                <a href="<?= url('admin/plan-update/' . $row->plan_id) ?>"><?= $data->plans[$row->plan_id]->name ?></a>
                            </div>

                            <?php if($row->plan_id != 'free'): ?>
                                <div>
                                    <small class="text-muted" data-toggle="tooltip" title="<?= l('admin_users.main.plan_expiration_date') ?>"><?= \Altum\Date::get($row->plan_expiration_date, 1) ?></small>
                                </div>
                            <?php endif ?>
                        </div>
                    </td>
                    <td class="text-nowrap">
                        <div class="d-flex align-items-center">
                            <span class="mr-2" data-toggle="tooltip" title="<?= sprintf(l('admin_users.table.datetime'), \Altum\Date::get($row->datetime, 1)) ?>">
                                <i class="fa fa-fw fa-calendar text-muted"></i>
                            </span>

                            <a href="<?= url('admin/users?source=' . $row->source) ?>" class="mr-2" data-toggle="tooltip" title="<?= l('admin_users.main.source.' . $row->source) ?>">
                                <i class="fa fa-fw fa-sign-in-alt text-muted"></i>
                            </a>

                            <span class="mr-2" data-toggle="tooltip" title="<?= sprintf(l('admin_users.table.last_activity'), ($row->last_activity ? \Altum\Date::get($row->last_activity, 1) : '-')) ?>">
                                <i class="fa fa-fw fa-history text-muted"></i>
                            </span>

                            <span class="mr-2" data-toggle="tooltip" title="<?= sprintf(l('admin_users.table.total_logins'), nr($row->total_logins)) ?>">
                                <i class="fa fa-fw fa-user-clock text-muted"></i>
                            </span>

                            <a href="<?= url('admin/users?continent=' . $row->continent_code) ?>" class="mr-2" data-toggle="tooltip" title="<?= get_continent_from_continent_code($row->continent_code ?? l('global.unknown')) ?>">
                                <i class="fa fa-fw fa-globe-europe text-muted"></i>
                            </a>

                            <a href="<?= url('admin/users?country=' . $row->country) ?>">
                                <?php if($row->country): ?>
                                    <img src="<?= ASSETS_FULL_URL . 'images/countries/' . mb_strtolower($row->country) . '.svg' ?>" class="icon-favicon mr-2" data-toggle="tooltip" title="<?= get_country_from_country_code($row->country) ?>" />
                                <?php else: ?>
                                    <span class="mr-2" data-toggle="tooltip" title="<?= l('global.unknown') ?>">
                                    <i class="fa fa-fw fa-flag text-muted"></i>
                                </span>
                                <?php endif ?>
                            </a>

                            <a href="<?= url('admin/users?city_name=' . $row->city_name) ?>" class="mr-2" data-toggle="tooltip" title="<?= $row->city_name ?? l('global.unknown') ?>">
                                <i class="fa fa-fw fa-city text-muted"></i>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-end">
                            <?= include_view(THEME_PATH . 'views/admin/users/admin_user_dropdown_button.php', ['id' => $row->user_id, 'resource_name' => $row->name]) ?>
                        </div>
                    </td>
                </tr>
            <?php endwhile ?>

            <tr>
                <td colspan="5">
                    <a href="<?= url('admin/users') ?>" class="text-muted">
                        <i class="fa fa-angle-right fa-sm fa-fw mr-1"></i> <?= l('global.view_more') ?>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<?php if(in_array(settings()->license->type, ['Extended License', 'extended'])): ?>
    <?php $result = database()->query("SELECT `payments`.*, `users`.`name` AS `user_name`, `users`.`email` AS `user_email` FROM `payments` LEFT JOIN `users` ON `payments`.`user_id` = `users`.`user_id` ORDER BY `id` DESC LIMIT 5"); ?>

    <?php if($result->num_rows): ?>
        <div class="mb-5">
            <h1 class="h3 mb-4"><i class="fa fa-fw fa-xs fa-credit-card text-primary-900 mr-2"></i> <?= l('admin_index.payments') ?></h1>

            <div class="table-responsive table-custom-container">
                <table class="table table-custom">
                    <thead>
                    <tr>
                        <th><?= l('global.user') ?></th>
                        <th><?= l('admin_payments.table.plan') ?></th>
                        <th><?= l('admin_payments.table.total_amount') ?></th>
                        <th><?= l('admin_payments.table.type') ?></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while($row = $result->fetch_object()): ?>
                        <?php //CODE:DEMO if(DEMO) {$row->email = $row->user_email = 'hidden@demo.com'; $row->user_name = $row->name = 'hidden on demo';} ?>
                        <?php $row->taxes_ids = json_decode($row->taxes_ids ?? ''); ?>

                        <tr>
                            <td class="text-nowrap">
                                <div class="d-flex align-items-center">
                                    <?php if($row->user_name || $row->user_email): ?>
                                        <a href="<?= url('admin/user-view/' . $row->user_id) ?>">
                                            <img src="<?= get_gravatar($row->user_email) ?>" class="user-avatar rounded-circle mr-3" alt="" />
                                        </a>

                                        <div class="d-flex flex-column">
                                            <div>
                                                <a href="<?= url('admin/user-view/' . $row->user_id) ?>"><?= $row->user_name ?></a>
                                            </div>

                                            <span class="text-muted"><?= $row->user_email ?></span>
                                        </div>
                                    <?php else: ?>
                                        <img src="<?= get_gravatar($row->user_email) ?>" class="user-avatar rounded-circle mr-3" alt="" />

                                        <div class="text-muted">
                                            <?= l('global.unknown') ?>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </td>

                            <td class="text-nowrap">
                                <?php if(isset($data->plans[$row->plan_id])): ?>
                                    <a href="<?= url('admin/plan-update/' . $row->plan_id) ?>">
                                        <?= $data->plans[$row->plan_id]->name ?>
                                    </a>
                                <?php else: ?>
                                    <?= $row->plan->name ?? l('global.unknown') ?>
                                <?php endif ?>
                            </td>

                            <td class="text-nowrap">
                                <span class="badge badge-success"><?= nr($row->total_amount, 2) . ' ' . $row->currency ?></span>
                            </td>

                            <td class="text-nowrap">
                                <div class="d-flex flex-column">
                                    <span><?= l('pay.custom_plan.' . $row->type . '_type') ?></span>
                                    <div>
                                        <span class="text-muted"><?= l('pay.custom_plan.' . $row->frequency) ?></span> - <span class="text-muted"><?= l('pay.custom_plan.' . $row->processor) ?></span>
                                    </div>
                                </div>
                            </td>

                            <td class="text-nowrap">
                                <span class="mr-2 <?= $row->code ? null : 'opacity-0' ?>" data-toggle="tooltip" title="<?= $row->code ? $row->code . ' (-' . nr($row->discount_amount, 2) . ' ' . $row->currency . ')' : null ?>">
                                    <i class="fa fa-fw fa-sm fa-tag text-muted"></i>
                                </span>

                                <?php
                                $taxes_html = null;
                                if(count($row->taxes_ids ?? [])) {
                                    $taxes_html = l('admin_taxes.menu') . ' - ';
                                    foreach ($row->taxes_ids as $tax_id) {
                                        $taxes_html .= '<a href=\'' . url('admin/tax-update/' . $tax_id) . '\' target=\'_blank\' class=\'mr-1\'>' . $tax_id . '</a>';
                                    }
                                }
                                ?>
                                <a href="#" onclick="return false;" class="mr-2 text-decoration-none <?= $taxes_html ? null : 'opacity-0' ?>" data-toggle="popover" data-placement="top" data-container="body" data-html="true" data-content="<?= $taxes_html ?>">
                                    <i class="fa fa-fw fa-sm fa-paperclip text-muted"></i>
                                </a>

                                <span class="mr-2" data-toggle="tooltip" data-html="true" title="<?= sprintf(l('global.datetime_tooltip'), '<br />' . \Altum\Date::get($row->datetime, 2) . '<br /><small>' . \Altum\Date::get($row->datetime, 3) . '</small>') ?>">
                                    <i class="fa fa-fw fa-calendar text-muted"></i>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <?= include_view(THEME_PATH . 'views/admin/payments/admin_payment_dropdown_button.php', [
                                        'id' => $row->id,
                                        'payment_proof' => $row->payment_proof,
                                        'processor' => $row->processor,
                                        'status' => $row->status
                                    ]) ?>
                                </div>
                            </td>
                        </tr>

                    <?php endwhile ?>

                    <tr>
                        <td colspan="6">
                            <a href="<?= url('admin/payments') ?>" class="text-muted">
                                <i class="fa fa-angle-right fa-sm fa-fw mr-1"></i> <?= l('global.view_more') ?>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif ?>
<?php endif ?>
