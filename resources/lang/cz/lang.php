<?php
    
    return [
        
        /*
         * General
         */
        'general'          => [
            'home'       => 'Domů',
            'good'       => 'dobře',
            'neutral'    => 'neutrální',
            'critical'   => 'kritické',
            'warning'    => 'varování',
            'migrations' => 'Migrace',
            'length'     => 'Délka',
            'tables'     => 'tabulky',
        ],
        
        /**
         * components/Pages/PrequelError.vue
         */
        'error_page'       => [
            'oops'               => 'Ups...',
            'tried_connecting'   => 'Pokus připojit se přes',
            'example_connection' => 'driver://user@host:port/database',
            'no_suggestions'     => 'Prequel nemohl navrhnout žádné opravy.',
            'disabled'           => 'Prequel byl zakázán.',
        ],
        
        /**
         * components/Elements/SwitchMode.vue
         */
        'switch_mode'      => [
            'browse' => [
                'title' => 'Režim prohlížení',
                'text'  => 'Procházet',
            ],
            'manage' => [
                'title' => 'Spravovat režim',
                'text'  => 'Spravovat',
            ],
        ],
        
        /**
         * components/Header/Header.vue
         */
        'header'           => [
            'column'  => 'Sloupec...',
            'value'   => 'Hodnota...',
            'records' => 'záznamů',
            'buttons' => [
                'dark_mode'   => 'Tmavý režim',
                'readability' => 'Čitelnost',
                'side_bar'    => 'Boční lišta',
                'refresh'     => 'Obnovit',
                'get'         => [
                    'title' => 'Spustit dotaz (ENTER)',
                    'text'  => 'Získat',
                ],
                'reset'       => [
                    'title' => 'Obnovit poptávku (ESC)',
                    'text'  => 'Obnovit',
                ],
            ],
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/Table.vue
         */
        'table'            => [
            'quick_actions' => 'Rýchle akce',
            'inspect_row'   => 'Zkontrolujte řádek',
            'item_empty'    => 'Prázdné',
            'nothing'       => 'Prázdné',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableEmpty.vue
         */
        'table_empty'      => [
            'no_results' => 'Tato poptávka nepřinesla žádný výsledek',
            'col_key'    => 'Klíč sloupce',
            'col_field'  => 'Pole sloupce',
            'col_def'    => 'Výchozí hodnota sloupce',
            'col_type'   => 'Typ sloupce',
            'not_set'    => 'Nenastaveno',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableStatus.vue
         */
        'table_status'     => [
            'loading_data'        => 'Načítají se data tabulky...',
            'error_occurred'      => 'Při načítání této tabulky se vyskytla chyba. Viz následující:',
            'could_not_resolve'   => 'Chybu se nepodařilo vyřešit',
            'prequel_suggestions' => 'Prequel navrhuje podívat se na následující body',
        ],
        
        /**
         * components/SideBar/SideBarWrapper.vue
         */
        'side_bar'         => [
            'look_for_table' => 'Hledat tabulku...',
        ],
        
        /**
         * components/SideBar/Menu/TableMenu.vue
         */
        'table_menu'       => [
            'empty_table' => 'Tato databáze neobsahuje žádné tabulky',
        ],
        
        /**
         * components/Dashboard/Dashboard.vue
         */
        'dashboard'        => [
            'overview'           => 'Přehled',
            'settings'           => 'Nastavení',
            'could_not_retrieve' => 'To se nepodařilo načíst...',
            'migrations'         => [
                'run_migrations'      => 'Spustit :number migrací',
                'no_run_migrations'   => 'Žádné čekající migrace',
                'reset_migrations'    => 'Obnovit :number migrací',
                'no_reset_migrations' => 'Žádné stávající migrace',
            ],
            'avg_query_speed'    => [
                'header' => 'Prům. počet dotazů za sekundu',
                'unit'   => 'poptávek za sekundu',
            ],
            'active_threads'     => [
                'header' => 'Aktivní vlákna',
                'unit'   => 'vláken',
            ],
            'open_tables'        => [
                'header' => 'Otevřené tabulky',
                'unit'   => 'tabulek',
            ],
            'uptime_hours'       => [
                'header' => 'Provozuschopné v hodinách',
                'unit'   => 'hodin',
            ],
            'uptime_minutes'     => [
                'header' => 'Provozuschopné v minutách',
                'unit'   => 'minut',
            ],
            'uptime_seconds'     => [
                'header' => 'Provozuschopné ve vteřinách',
                'unit'   => 'vteřin',
            ],
        ],
        
        /**
         * components/MainContent/ManageMode/ManageTable.vue
         */
        'table_management' => [
            'insert_new_row' => 'Vytvořit řádek',
            'view_structure' => 'Zobrazit strukturu',
            'run_sql'        => 'Spustit SQL',
            'import'         => 'Import',
            'export'         => 'Export',
            'log'            => 'Log',
            'settings'       => 'Nastavení',
        ],
    ];
