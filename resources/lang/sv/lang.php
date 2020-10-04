<?php
    
    return [
        
        /*
         * General
         */
        'general'          => [
            'home'       => 'Hem',
            'good'       => 'god',
            'neutral'    => 'neutral',
            'critical'   => 'kritisk',
            'warning'    => 'varning',
            'migrations' => 'MigrationAction',
            'length'     => 'längd',
            'tables'     => 'tabeller',
        ],
        
        /**
         * components/Pages/PrequelError.vue
         */
        'error_page'       => [
            'oops'               => 'Ojdå...',
            'tried_connecting'   => 'Försökte koppla via',
            'example_connection' => 'driver://user@host:port/database',
            'no_suggestions'     => 'Prequel kunde inte föreslå några lösningar.',
            'disabled'           => 'Prequel är avaktiverat.',
        ],
        
        /**
         * components/Elements/SwitchMode.vue
         */
        'switch_mode'      => [
            'browse' => [
                'title' => 'Visningsläge',
                'text'  => 'Visa',
            ],
            'manage' => [
                'title' => 'Editeringsläge',
                'text'  => 'Editera',
            ],
        ],
        
        /**
         * components/Header/Header.vue
         */
        'header'           => [
            'column'  => 'Kolumn...',
            'value'   => 'Värde...',
            'records' => 'objekt',
            'buttons' => [
                'dark_mode'   => 'Nattläge',
                'readability' => 'Läsbarhet',
                'side_bar'    => 'Side Bar',
                'refresh'     => 'Ladda om',
                'get'         => [
                    'title' => 'Kör fråga (ENTER)',
                    'text'  => 'Kör',
                ],
                'reset'       => [
                    'title' => 'Återställ fråga (ESC)',
                    'text'  => 'Återställ',
                ],
            ],
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/Table.vue
         */
        'table'            => [
            'quick_actions' => 'Snabbkomando',
            'inspect_row'   => 'Inspektera rad',
            'item_empty'    => 'Ingen data',
            'nothing'       => 'Ingen data',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableEmpty.vue
         */
        'table_empty'      => [
            'no_results' => 'Denna fråga resulterade inte i några resultat',
            'col_key'    => 'Kolumnnyckel',
            'col_field'  => 'Kolumnfält',
            'col_def'    => 'Kolumnstandard',
            'col_type'   => 'Kolumntyp',
            'not_set'    => 'Inte satt',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableStatus.vue
         */
        'table_status'     => [
            'loading_data'        => 'Laddar tabelldata...',
            'error_occurred'      => 'Det uppstod ett problem vid laddandet av tabelldata. Se följande:',
            'could_not_resolve'   => 'Anslutningsfel',
            'prequel_suggestions' => 'Prequel föreslår att du ser över följande punktar',
        ],
        
        /**
         * components/SideBar/SideBarWrapper.vue
         */
        'side_bar'         => [
            'look_for_table' => 'Sök tabell...',
        ],
        
        /**
         * components/SideBar/Menu/TableMenu.vue
         */
        'table_menu'       => [
            'empty_table' => 'Denna databas har inga tabeller',
        ],
        
        /**
         * components/Dashboard/Dashboard.vue
         */
        'dashboard'        => [
            'overview'           => 'Översikt',
            'settings'           => 'Inställningar',
            'could_not_retrieve' => 'Kunde inte hämta detta...',
            'migrations'         => [
                'run_migrations'      => 'Kör :number migration(er)',
                'no_run_migrations'   => 'Inga väntande migrationer',
                'reset_migrations'    => 'Återställ :number migration(er)',
                'no_reset_migrations' => 'Det finns inga mingrationer',
            ],
            'avg_query_speed'    => [
                'header' => 'Medel Frågor per sekund',
                'unit'   => 'frågor per sekund',
            ],
            'active_threads'     => [
                'header' => 'Aktiva Trådar',
                'unit'   => 'trådar',
            ],
            'open_tables'        => [
                'header' => 'Öppna Tabeller',
                'unit'   => 'tabeller',
            ],
            'uptime_hours'       => [
                'header' => 'Upptid i timmar',
                'unit'   => 'timmar',
            ],
            'uptime_minutes'     => [
                'header' => 'Upptid i minuter',
                'unit'   => 'minuter',
            ],
            'uptime_seconds'     => [
                'header' => 'Upptid i sekunder',
                'unit'   => 'seconder',
            ],
        ],
        
        /**
         * components/MainContent/ManageMode/ManageTable.vue
         */
        'table_management' => [
            'insert_new_row' => 'Lägg till ny rad',
            'view_structure' => 'Visa struktur',
            'run_sql'        => 'Kör SQL',
            'import'         => 'Importera',
            'export'         => 'Exportera',
            'log'            => 'Log',
            'settings'       => 'Inställningar',
        ],
    ];
