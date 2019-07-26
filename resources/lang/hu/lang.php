<?php


return [

    /*
     * General
     */
    'general'      => [
        'home'       => 'Otthon',
        'good'       => 'J�',
        'neutral'    => 'Semleges',
        'critical'   => 'Kritikus',
        'warning'    => 'Vigyázat',
        'migrations' => 'Migrations',
        'length'     => 'Length',
        'tables'     => 'Táblák',
    ],

    /**
     * Elements/PrequelError.vue
     */
    'error_page'   => [
        'oops'               => 'Oops...',
        'tried_connecting'   => 'Csatlakozás megkis�rl�se.',
        'example_connection' => 'connection://user@host:port/database',
        'no_suggestions'     => 'Az el�zm�ny nem javasolhat jav�t�sokat.',
        'disabled'           => 'Az el�zm�ny le van tiltva.',
    ],

    /**
     * Elements/SwitchMode.vue
     */
    'switch_mode'  => [
        'browse' => [
            'title' => 'Browse mode',
            'text'  => 'Keres',
        ],
        'manage' => [
            'title' => 'Manage mode',
            'text'  => 'Kezel',
        ],
    ],

    /**
     * Header/Header.vue
     */
    'header'       => [
        'column'  => 'Column...',
        'value'   => 'Value...',
        'records' => 'Feljegyz�sek',
        'buttons' => [
            'dark_mode'   => 'S�t�t m�d',
            'readability' => 'Readability',
            'side_bar'    => 'Side Bar',
            'get'         => [
                'title' => 'Run query (ENTER)',
                'text'  => 'Get',
            ],
            'reset'       => [
                'title' => 'Reset query (ESC)',
                'text'  => 'reset',
            ],
        ],
    ],

    /**
     * MainContent/Table/Table.vue
     */
    'table'        => [
        'quick_actions' => 'Quick actions',
        'inspect_row'   => 'Inspect row',
        'item_empty'    => 'Az eszk�z �res',
        'nothing'       => 'Nothing here',
    ],

    /**
     * MainContent/Table/TableEmpty.vue
     */
    'table_empty'  => [
        'no_results' => 'This query did not yield any result',
        'col_key'    => 'Column Key',
        'col_field'  => 'Column Field',
        'col_def'    => 'Column Default',
        'col_type'   => 'Column Type',
        'not_set'    => 'Not Set',
    ],

    /**
     * MainContent/Table/TableStatus.vue
     */
    'table_status' => [
        'loading_data'        => 'Loading table data...',
        'error_occurred'      => 'There was an error while loading this table. See the following:',
        'could_not_resolve'   => 'Could not resolve error',
        'prequel_suggestions' => 'Prequel suggests looking at the following points',
    ],

    /**
     * SideBar/SideBarWrapper.vue
     */
    'side_bar'     => [
        'look_for_table' => 'Look for table...',
    ],

    /**
     * SideBar/TableMenu.vue
     */
    'table_menu'   => [
        'empty_table' => 'This database does not contain any tables',
    ],

    /**
     * MainContent/ManageDatabase
     */
    'dashboard'    => [
        'overview'           => '�ttekint�s',
        'settings'           => 'Beállit�sok',
        'could_not_retrieve' => 'Could not retrieve this...',
        'migrations'         => [
            'run_migrations'      => 'Run :number migration(s)',
            'no_run_migrations'   => 'No pending migrations',
            'reset_migrations'    => 'Reset :number migration(s)',
            'no_reset_migrations' => 'No existing migrations',
        ],
        'avg_query_speed'    => [
            'header' => 'Avg. Queries Per Second',
            'unit'   => 'queries per second',
        ],
        'active_threads'     => [
            'header' => 'Active Threads',
            'unit'   => 'threads',
        ],
        'open_tables'        => [
            'header' => 'Open Tables',
            'unit'   => 'táblák',
        ],
        'uptime_hours'       => [
            'header' => 'Uptime in hours',
            'unit'   => 'óra',
        ],
        'uptime_minutes'     => [
            'header' => 'Uptime in minutes',
            'unit'   => 'perc',
        ],
        'uptime_seconds'     => [
            'header' => 'Uptime in seconds',
            'unit'   => 'másodperc',
        ],
    ],

];
