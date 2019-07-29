<?php


return [

    /*
     * General
     */
    'general'      => [
        'home'       => 'Otthon',
        'good'       => 'Jó',
        'neutral'    => 'Semleges',
        'critical'   => 'Kritikus',
        'warning'    => 'Vigyázat',
        'migrations' => 'Migrációk',
        'length'     => 'Hosszúság',
        'tables'     => 'Táblák',
    ],

    /**
     * Elements/PrequelError.vue
     */
    'error_page'   => [
        'oops'               => 'Hopsz...',
        'tried_connecting'   => 'Csatlakozás megkísérelve',
        'example_connection' => 'connection://user@host:port/database',
        'no_suggestions'     => 'Prequel nem tudott javascolni javításokat.',
        'disabled'           => 'Prequel le van tiltva.',
    ],

    /**
     * Elements/SwitchMode.vue
     */
    'switch_mode'  => [
        'browse' => [
            'title' => 'Keresési mód',
            'text'  => 'Keresés',
        ],
        'manage' => [
            'title' => 'Kezelői mód',
            'text'  => 'Kezelői',
        ],
    ],

    /**
     * Header/Header.vue
     */
    'header'       => [
        'column'  => 'Oszlop...',
        'value'   => 'Érték...',
        'records' => 'találat',
        'buttons' => [
            'dark_mode'   => 'Sötét mód',
            'readability' => 'Olvashatóság',
            'side_bar'    => 'Oldalsó menü',
            'get'         => [
                'title' => 'Kérés futtatása (ENTER)',
                'text'  => 'Mehet',
            ],
            'reset'       => [
                'title' => 'Kérés visszaállítása (ESC)',
                'text'  => 'Visszaállítás',
            ],
        ],
    ],

    /**
     * MainContent/Table/Table.vue
     */
    'table'        => [
        'quick_actions' => 'Gyors akciók',
        'inspect_row'   => 'Sor megtekintése',
        'item_empty'    => 'Az eszköz üres',
        'nothing'       => 'Üres',
    ],

    /**
     * MainContent/Table/TableEmpty.vue
     */
    'table_empty'  => [
        'no_results' => 'Ez a keresés nem hozott eredményt',
        'col_key'    => 'Oszlop Kulcs',
        'col_field'  => 'Oszlop Neve',
        'col_def'    => 'Alapértelmezett érték',
        'col_type'   => 'Oszlop Típusa',
        'not_set'    => 'Nincs beállítva',
    ],

    /**
     * MainContent/Table/TableStatus.vue
     */
    'table_status' => [
        'loading_data'        => 'Adatok betöltése...',
        'error_occurred'      => 'Hiba történt az adatok betöltésekor. Lásd az alábbiakat:',
        'could_not_resolve'   => 'Ismeretlen hiba lépett fel',
        'prequel_suggestions' => 'Prequel ajánlja a következő problémák ellenőrzését',
    ],

    /**
     * SideBar/SideBarWrapper.vue
     */
    'side_bar'     => [
        'look_for_table' => 'Keresés...',
    ],

    /**
     * SideBar/TableMenu.vue
     */
    'table_menu'   => [
        'empty_table' => 'Ez az adatbázis nem tartalmaz táblát',
    ],

    /**
     * MainContent/ManageDatabase
     */
    'dashboard'    => [
        'overview'           => 'Áttekintés',
        'settings'           => 'Beállitások',
        'could_not_retrieve' => 'Nem sikerült lekérni...',
        'migrations'         => [
            'run_migrations'      => ':number migráció futtatása',
            'no_run_migrations'   => 'Nincs függőben lévő migráció',
            'reset_migrations'    => ':number migrűció visszaállítása',
            'no_reset_migrations' => 'Nincs előző migráció',
        ],
        'avg_query_speed'    => [
            'header' => 'Átlag kérés másodpercenként',
            'unit'   => 'kérés per másodperc',
        ],
        'active_threads'     => [
            'header' => 'Aktív Szál',
            'unit'   => 'szál',
        ],
        'open_tables'        => [
            'header' => 'Nyitott táblá',
            'unit'   => 'tábla',
        ],
        'uptime_hours'       => [
            'header' => 'Futási idő órában',
            'unit'   => 'óra',
        ],
        'uptime_minutes'     => [
            'header' => 'Futási idő percben',
            'unit'   => 'perc',
        ],
        'uptime_seconds'     => [
            'header' => 'Futási idő másodpercben',
            'unit'   => 'másodperc',
        ],
    ],

];
