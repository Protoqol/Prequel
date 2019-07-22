<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Prequel i18n
    |--------------------------------------------------------------------------
    |
    | All Prequel translations.
    |
    */

    /*
     * General keywords.
     */

    'general' => [
        'good'     => 'good',
        'neutral'  => 'neutral',
        'critical' => 'critical',
    ],

    'buttons' => [
        'dark_mode'   => 'Dark Mode',
        'readability' => 'Readability',
        'side_bar'    => 'Side Bar',
    ],

    /*
     * Everything on the dashboard.
     */

    'dashboard' => [
        'overview'           => 'Overview',
        'could_not_retrieve' => 'Could not retrieve this...',
        'migrations'         => [
            'run_migrations'      => 'Run :number migration(s)',
            'no_run_migrations'   => 'No pending migrations',
            'reset_migrations'    => 'Reset :number migration(s)',
            'no_reset_migrations' => 'No existing migrations',
        ],
        'avg_query_speed'    => [
            'header' => 'Average Query Speed',
            'unit'   => 'queries per second',
        ],
        'active_threads'     => [
            'header' => 'Active Threads',
            'unit'   => 'threads',
        ],
        'open_tables'        => [
            'header' => 'Open Tables',
            'unit'   => 'tables',
        ],
        'uptime_hours'       => [
            'header' => 'Uptime in hours',
            'unit'   => 'hours',
        ],
        'uptime_minutes'     => [
            'header' => 'Uptime in minutes',
            'unit'   => 'minutes',
        ],
        'uptime_seconds'     => [
            'header' => 'Uptime in seconds',
            'unit'   => 'seconds',
        ],
    ],

];
