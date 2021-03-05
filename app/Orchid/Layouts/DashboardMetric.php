<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Metric;

class DashboardMetric extends Metric
{
    /**
     * @var string
     */
    protected $title = 'Insights';

    /**
     * Get the labels available for the metric.
     *
     * @return array
     */
    protected $labels = [
        'Total Companies',
        'Total Subscriptions',
        'Total Sectors',
        'Total Sub Sectors',
        'Total States',
        'Total Cities',
    ];

    /**
     * The name of the key to fetch it from the query.
     *
     * @var string
     */
    protected $target = 'metrics';
}
