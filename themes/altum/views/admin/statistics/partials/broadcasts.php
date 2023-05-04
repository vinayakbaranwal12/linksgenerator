<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<div class="card mb-5">
    <div class="card-body">
        <h2 class="h4"><i class="fa fa-fw fa-mail-bulk fa-xs text-muted"></i> <?= l('admin_statistics.broadcasts.header') ?></h2>
        <div class="d-flex flex-column flex-xl-row">
            <div class="mb-2 mb-xl-0 mr-4">
                <span class="font-weight-bold"><?= nr($data->total['broadcasts']) ?></span> <?= l('admin_statistics.broadcasts.chart_broadcasts') ?>
            </div>

            <div class="mb-2 mb-xl-0 mr-4">
                <span class="font-weight-bold"><?= nr($data->total['sent_emails']) ?></span> <?= l('admin_statistics.broadcasts.chart_sent_emails') ?>
            </div>
        </div>

        <div class="chart-container">
            <canvas id="broadcasts"></canvas>
        </div>
    </div>
</div>
<?php $html = ob_get_clean() ?>

<?php ob_start() ?>
    <script>
        'use strict';

        let broadcasts_color = css.getPropertyValue('--gray-500');
        let sent_emails_color = css.getPropertyValue('--primary');

        /* Display chart */
        let broadcasts_chart = document.getElementById('broadcasts').getContext('2d');

        let sent_emails_color_gradient = broadcasts_chart.createLinearGradient(0, 0, 0, 250);
        sent_emails_color_gradient.addColorStop(0, 'rgba(63, 136, 253, .1)');
        sent_emails_color_gradient.addColorStop(1, 'rgba(63, 136, 253, 0.025)')

        let broadcasts_color_gradient = broadcasts_chart.createLinearGradient(0, 0, 0, 250);
        broadcasts_color_gradient.addColorStop(0, 'rgba(160, 174, 192, .1)');
        broadcasts_color_gradient.addColorStop(1, 'rgba(160, 174, 192, 0.025)')

        new Chart(broadcasts_chart, {
            type: 'line',
            data: {
                labels: <?= $data->broadcasts_chart['labels'] ?>,
                datasets: [
                    {
                        label: <?= json_encode(l('admin_statistics.broadcasts.chart_broadcasts')) ?>,
                        data: <?= $data->broadcasts_chart['broadcasts'] ?? '[]' ?>,
                        backgroundColor: broadcasts_color_gradient,
                        borderColor: broadcasts_color,
                        fill: true
                    },
                    {
                        label: <?= json_encode(l('admin_statistics.broadcasts.chart_sent_emails')) ?>,
                        data: <?= $data->broadcasts_chart['sent_emails'] ?? '[]' ?>,
                        backgroundColor: sent_emails_color_gradient,
                        borderColor: sent_emails_color,
                        fill: true
                    }
                ]
            },
            options: chart_options
        });
    </script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
