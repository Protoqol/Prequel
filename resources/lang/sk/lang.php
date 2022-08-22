<?php
    
    return [
        
        /*
         * General
         */
        'general'          => [
            'home'       => 'Domov',
            'good'       => 'dobre',
            'neutral'    => 'neutrálne',
            'critical'   => 'kritické',
            'warning'    => 'varovanie',
            'migrations' => 'Migrácie',
            'length'     => 'Dĺžka',
            'tables'     => 'tabuľky',
        ],
        
        /**
         * components/Pages/PrequelError.vue
         */
        'error_page'       => [
            'oops'               => 'Ups...',
            'tried_connecting'   => 'Pokus pripojiť sa cez',
            'example_connection' => 'driver://user@host:port/database',
            'no_suggestions'     => 'Prequel nemohol navrhnúť žiadne opravy.',
            'disabled'           => 'Prequel bol zakázaný.',
        ],
        
        /**
         * components/Elements/SwitchMode.vue
         */
        'switch_mode'      => [
            'browse' => [
                'title' => 'Režim prehliadania',
                'text'  => 'Prehľadávať',
            ],
            'manage' => [
                'title' => 'Spravovať režim',
                'text'  => 'Spravovať',
            ],
        ],
        
        /**
         * components/Header/Header.vue
         */
        'header'           => [
            'column'  => 'Stĺpec...',
            'value'   => 'Hodnota...',
            'records' => 'záznamov',
            'buttons' => [
                'dark_mode'   => 'Tmavý režim',
                'readability' => 'Čitateľnosť',
                'side_bar'    => 'Bočná lišta',
                'refresh'     => 'Obnoviť',
                'get'         => [
                    'title' => 'Spustiť dotaz (ENTER)',
                    'text'  => 'Získať',
                ],
                'reset'       => [
                    'title' => 'Obnoviť dopyt (ESC)',
                    'text'  => 'Obnoviť',
                ],
            ],
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/Table.vue
         */
        'table'            => [
            'quick_actions' => 'Rýchle akcie',
            'inspect_row'   => 'Skontrolujte riadok',
            'item_empty'    => 'Prázdne',
            'nothing'       => 'Prázdne',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableEmpty.vue
         */
        'table_empty'      => [
            'no_results' => 'Tento dopyt nepriniesol žiadny výsledok',
            'col_key'    => 'Kľúč stĺpca',
            'col_field'  => 'Pole stĺpca',
            'col_def'    => 'Predvolená hodnota stĺpca',
            'col_type'   => 'Typ stĺpca',
            'not_set'    => 'Nenastavené',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableStatus.vue
         */
        'table_status'     => [
            'loading_data'        => 'Načítavajú sa údaje tabuľky...',
            'error_occurred'      => 'Pri načítavaní tejto tabuľky sa vyskytla chyba. Pozrite si nasledovné:',
            'could_not_resolve'   => 'Chybu sa nepodarilo vyriešiť',
            'prequel_suggestions' => 'Prequel navrhuje pozrieť sa na nasledujúce body',
        ],
        
        /**
         * components/SideBar/SideBarWrapper.vue
         */
        'side_bar'         => [
            'look_for_table' => 'Hľadať tabuľku...',
        ],
        
        /**
         * components/SideBar/Menu/TableMenu.vue
         */
        'table_menu'       => [
            'empty_table' => 'Táto databáza neobsahuje žiadne tabuľky',
        ],
        
        /**
         * components/Dashboard/Dashboard.vue
         */
        'dashboard'        => [
            'overview'           => 'Prehľad',
            'settings'           => 'Nastavenia',
            'could_not_retrieve' => 'Toto sa nepodarilo načítať...',
            'migrations'         => [
                'run_migrations'      => 'Spustiť :number migrácií',
                'no_run_migrations'   => 'Žiadne čakajúce migrácie',
                'reset_migrations'    => 'Obnoviť :number migrácií',
                'no_reset_migrations' => 'Žiadne existujúce migrácie',
            ],
            'avg_query_speed'    => [
                'header' => 'Priem. počet dopytov za sekundu',
                'unit'   => 'dopytov za sekundu',
            ],
            'active_threads'     => [
                'header' => 'Aktívne vlákna',
                'unit'   => 'vlákien',
            ],
            'open_tables'        => [
                'header' => 'Otvorené tabuľky',
                'unit'   => 'tabuliek',
            ],
            'uptime_hours'       => [
                'header' => 'Prevádzkyschopné v hodinách',
                'unit'   => 'hodín',
            ],
            'uptime_minutes'     => [
                'header' => 'Prevádzkyschopné v minútach',
                'unit'   => 'minút',
            ],
            'uptime_seconds'     => [
                'header' => 'Prevádzkyschopné v sekundách',
                'unit'   => 'sekúnd',
            ],
        ],
        
        /**
         * components/MainContent/ManageMode/ManageTable.vue
         */
        'table_management' => [
            'insert_new_row' => 'Vytvoriť riadok',
            'view_structure' => 'Zobraziť štruktúru',
            'run_sql'        => 'Spustiť SQL',
            'import'         => 'Import',
            'export'         => 'Export',
            'log'            => 'Log',
            'settings'       => 'Nastavenia',
        ],
    ];
