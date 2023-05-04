<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<div class="card mb-5">
    <div class="card-body">
        <h2 class="h4"><i class="fa fa-fw fa-comments fa-xs text-muted"></i> <?= l('admin_statistics.chats.header') ?></h2>
        <div class="d-flex flex-column flex-xl-row">
            <div class="mb-2 mb-xl-0 mr-4">
                <span class="font-weight-bold"><?= nr($data->total['chats']) ?></span> <?= l('admin_statistics.chats.chart') ?>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="chats"></canvas>
        </div>
    </div>
</div>

<?php $html = ob_get_clean() ?>

<?php ob_start() ?>
<script>
    'use strict';

    let color = css.getPropertyValue('--primary');
    let color_gradient = null;

    /* Display chart */
    let chats_chart = document.getElementById('chats').getContext('2d');
    color_gradient = chats_chart.createLinearGradient(0, 0, 0, 250);
    color_gradient.addColorStop(0, 'rgba(63, 136, 253, .1)');
    color_gradient.addColorStop(1, 'rgba(63, 136, 253, 0.025)');

    new Chart(chats_chart, {
        type: 'line',
        data: {
            labels: <?= $data->chats_chart['labels'] ?>,
            datasets: [
                {
                    label: <?= json_encode(l('admin_statistics.chats.chart')) ?>,
                    data: <?= $data->chats_chart['chats'] ?? '[]' ?>,
                    backgroundColor: color_gradient,
                    borderColor: color,
                    fill: true
                }
            ]
        },
        options: chart_options
    });
</script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
