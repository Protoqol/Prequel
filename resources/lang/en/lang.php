<?php
    
    return [
        
        /*
         * General
         */
        'general'          => [
            'home'       => 'Home',
            'good'       => 'good',
            'neutral'    => 'neutral',
            'critical'   => 'critical',
            'warning'    => 'warning',
            'migrations' => 'MigrationAction',
            'length'     => 'Length',
            'tables'     => 'tables',
        ],
        
        /**
         * components/Pages/PrequelError.vue
         */
        'error_page'       => [
            'oops'               => 'Oops...',
            'tried_connecting'   => 'Tried connecting through',
            'example_connection' => 'driver://user@host:port/database',
            'no_suggestions'     => 'Prequel could not suggest any fixes.',
            'disabled'           => 'Prequel has been disabled.',
        ],
        
        /**
         * components/Elements/SwitchMode.vue
         */
        'switch_mode'      => [
            'browse' => [
                'title' => 'Browse mode',
                'text'  => 'Browse',
            ],
            'manage' => [
                'title' => 'Manage mode',
                'text'  => 'Manage',
            ],
        ],
        
        /**
         * components/Header/Header.vue
         */
        'header'           => [
            'column'  => 'Column...',
            'value'   => 'Value...',
            'records' => 'records',
            'buttons' => [
                'dark_mode'   => 'Dark Mode',
                'readability' => 'Readability',
                'side_bar'    => 'Side Bar',
                'refresh'     => 'Refresh',
                'get'         => [
                    'title' => 'Run query (ENTER)',
                    'text'  => 'Get',
                ],
                'reset'       => [
                    'title' => 'Reset query (ESC)',
                    'text'  => 'Reset',
                ],
            ],
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/Table.vue
         */
        'table'            => [
            'quick_actions' => 'Quick actions',
            'inspect_row'   => 'Inspect row',
            'item_empty'    => 'Nothing here',
            'nothing'       => 'Nothing here',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableEmpty.vue
         */
        'table_empty'      => [
            'no_results' => 'This query did not yield any result',
            'col_key'    => 'Column Key',
            'col_field'  => 'Column Field',
            'col_def'    => 'Column Default',
            'col_type'   => 'Column Type',
            'not_set'    => 'Not Set',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableStatus.vue
         */
        'table_status'     => [
            'loading_data'        => 'Loading table data...',
            'error_occurred'      => 'There was an error while loading this table. See the following:',
            'could_not_resolve'   => 'Could not resolve error',
            'prequel_suggestions' => 'Prequel suggests looking at the following points',
        ],
        
        /**
         * components/SideBar/SideBarWrapper.vue
         */
        'side_bar'         => [
            'look_for_table' => 'Look for table...',
        ],
        
        /**
         * components/SideBar/Menu/TableMenu.vue
         */
        'table_menu'       => [
            'empty_table' => 'This database does not contain any tables',
        ],
        
        /**
         * components/Dashboard/Dashboard.vue
         */
        'dashboard'        => [
            'overview'           => 'Overview',
            'settings'           => 'Settings',
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
        
        /**
         * components/MainContent/ManageMode/ManageTable.vue
         */
        'table_management' => [
            'insert_new_row' => 'Insert New Row',
            'view_structure' => 'View Structure',
            'run_sql'        => 'Run SQL',
            'import'         => 'Import',
            'export'         => 'Export',
            'log'            => 'Log',
            'settings'       => 'Settings',
        ],
    ];
