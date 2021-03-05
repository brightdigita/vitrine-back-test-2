<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Chart;

class DashboardChart extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Insights charts';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'bar';

    /**
     * Set the labels for each possible field value.
     *
     * @deprecated
     *
     * @var array
     */
    protected $labels = [];

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'charts';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = false;
}
