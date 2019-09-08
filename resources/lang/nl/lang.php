<?php


return [

    /*
     * General
     */
    'general'      => [
        'good'       => 'goed',
        'neutral'    => 'neutraal',
        'critical'   => 'kritiek',
        'warning'    => 'waarschuwing',
        'get'        => 'Zoek',
        'reset'      => 'Reset',
        'migrations' => 'Migraties',
        'length'     => 'Lengte',
        'tables'     => 'tabellen',
    ],

    /**
     * Elements/PrequelError.vue
     */
    'error_page'   => [
        'oops'               => 'Oeps...',
        'tried_connecting'   => 'Geprobeerd te verbinden met...',
        'example_connection' => 'driver://gebruiker@host:poort/database',
        'no_suggestions'     => 'Prequel kon geen oplossingen vinden.',
        'disabled'           => 'Prequel is uitgeschakeld.',
    ],

    /**
     * Elements/SwitchMode.vue
     */
    'switch_mode'  => [
        'browse' => [
            'title' => 'Blader modus',
            'text'  => 'Blader',
        ],
        'manage' => [
            'title' => 'Beheer modus',
            'text'  => 'Beheer',
        ],
    ],

    /**
     * Header/Header.vue
     */
    'header'       => [
        'column'  => 'Kolom...',
        'value'   => 'Waarde...',
        'records' => 'records',
        'buttons' => [
            'dark_mode'   => 'Donkere Modus',
            'readability' => 'Leesbaarheid',
            'side_bar'    => 'Zijbalk',
            'get'         => [
                'title' => 'Draai query (ENTER)',
                'text'  => 'Zoek',
            ],
            'reset'       => [
                'title' => 'Herstel query (ESC)',
                'text'  => 'Herstel',
            ],
        ],
    ],

    /**
     * MainContent/Table/Table.vue
     */
    'table'        => [
        'quick_actions' => 'Snelacties',
        'inspect_row'   => 'Inspecteer rij',
        'item_empty'    => 'Dit item is leeg',
        'nothing'       => 'Niks hier',
    ],

    /**
     * MainContent/Table/TableEmpty.vue
     */
    'table_empty'  => [
        'no_results' => 'Deze query kreeg geen resultaten terug',
        'col_key'    => 'Kolom Sleutel',
        'col_field'  => 'Kolom Veld',
        'col_def'    => 'Kolom Standaard',
        'col_type'   => 'Kolom Type',
        'not_set'    => 'Niet gedefinieerd',
    ],

    /**
     * MainContent/Table/TableStatus.vue
     */
    'table_status' => [
        'loading_data'        => 'Tabel data laden...',
        'error_occurred'      => 'Er was een fout tijdens het laden. Zie het volgende:',
        'could_not_resolve'   => 'Kon fout niet oplossen',
        'prequel_suggestions' => 'Prequel suggereerd de volgende punten',
    ],

    /**
     * SideBar/SideBarWrapper.vue
     */
    'side_bar'     => [
        'look_for_table' => 'Zoek een tabel...',
    ],

    /**
     * SideBar/TableMenu.vue
     */
    'table_menu'   => [
        'empty_table' => 'Deze database bevat geen tabellen',
    ],

    /**
     * MainContent/ManageDatabase
     */
    'dashboard'    => [
        'overview'           => 'Overzicht',
        'settings'           => 'Instellingen',
        'could_not_retrieve' => 'Kon dit niet ophalen...',
        'migrations'         => [
            'run_migrations'      => 'Draai :number migraties(s)',
            'no_run_migrations'   => 'Geen migraties in wachtrij',
            'reset_migrations'    => 'Reset :number migratie(s)',
            'no_reset_migrations' => 'Geen bestaande migraties',
        ],
        'avg_query_speed'    => [
            'header' => 'Gem. Queries Per Seconde',
            'unit'   => 'queries per seconde',
        ],
        'active_threads'     => [
            'header' => 'Actieve Threads',
            'unit'   => 'threads',
        ],
        'open_tables'        => [
            'header' => 'Open Tabellen',
            'unit'   => 'tabellen',
        ],
        'uptime_hours'       => [
            'header' => 'Tijd actief in uren',
            'unit'   => 'uren',
        ],
        'uptime_minutes'     => [
            'header' => 'Tijd actief in minuten',
            'unit'   => 'minuten',
        ],
        'uptime_seconds'     => [
            'header' => 'Tijd actief in seconden',
            'unit'   => 'seconden',
        ],
    ],

];
