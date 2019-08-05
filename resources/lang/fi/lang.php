<?php


return [

    /**
     * General
     */
    'general'      => [
        'home'       => 'Koti',
        'good'       => 'hyvä',
        'neutral'    => 'neutraali',
        'critical'   => 'kriittinen',
        'warning'    => 'varoitus',
        'migrations' => 'Migraatiot',
        'length'     => 'Pituus',
        'tables'     => 'taulukoita',
    ],

    /**
     * Elements/PrequelError.vue
     */
    'error_page'   => [
        'oops'               => 'Oho...',
        'tried_connecting'   => 'Yritettiin muodostaa yhteys käyttäen',
        'example_connection' => 'connection://user@host:port/database',
        'no_suggestions'     => 'Prequel ei kyennyt ehdottamaan korjauksia.',
        'disabled'           => 'Prequel on poistettu käytöstä.',
    ],

    /**
     * Elements/SwitchMode.vue
     */
    'switch_mode'  => [
        'browse' => [
            'title' => 'Selaustila',
            'text'  => 'Selaa',
        ],
        'manage' => [
            'title' => 'Hallinnointitila',
            'text'  => 'Hallitse',
        ],
    ],

    /**
     * Header/Header.vue
     */
    'header'       => [
        'column'  => 'Kolumni...',
        'value'   => 'Arvo...',
        'records' => 'arkisto',
        'buttons' => [
            'dark_mode'   => 'Tumma Moodi',
            'readability' => 'Luettavuus',
            'side_bar'    => 'Sivupalkki',
            'get'         => [
                'title' => 'Suorita kysely (ENTER)',
                'text'  => 'Hae',
            ],
            'reset'       => [
                'title' => 'Nollaa kysely (ESC)',
                'text'  => 'Nollaa',
            ],
        ],
    ],

    /**
     * MainContent/Table/Table.vue
     */
    'table'        => [
        'quick_actions' => 'Nopeat toimet',
        'inspect_row'   => 'Tarkista rivi',
        'item_empty'    => 'Tämä osio on tyhjä',
        'nothing'       => 'Ei mitään täällä',
    ],

    /**
     * MainContent/Table/TableEmpty.vue
     */
    'table_empty'  => [
        'no_results' => 'Tämä kysely ei tuottanut yhtään tulosta',
        'col_key'    => 'Sarakkeen Avain',
        'col_field'  => 'Sarakkeen Kenttä',
        'col_def'    => 'Sarakkeen Oletus',
        'col_type'   => 'Sarakkeen Tyyppi',
        'not_set'    => 'Ei Asetettu',
    ],

    /**
     * MainContent/Table/TableStatus.vue
     */
    'table_status' => [
        'loading_data'        => 'Ladataan taulukon tietoja...',
        'error_occurred'      => 'Ladattaessa tätä taulukkoa tapahtui virhe. Tarkista seuraava:',
        'could_not_resolve'   => 'Virhettä ei voitu ratkaista',
        'prequel_suggestions' => 'Prequel ehdottaa seuraavien kohteiden katsomista',
    ],

    /**
     * SideBar/SideBarWrapper.vue
     */
    'side_bar'     => [
        'look_for_table' => 'Hae taulukkoa...',
    ],

    /**
     * SideBar/TableMenu.vue
     */
    'table_menu'   => [
        'empty_table' => 'Tämä tietokanta ei sisällä yhtään taulukkoa',
    ],

    /**
     * MainContent/ManageDatabase
     */
    'dashboard'    => [
        'overview'           => 'Yleiskuva',
        'settings'           => 'Asetukset',
        'could_not_retrieve' => 'Tätä ei voitu noutaa...',
        'migrations'         => [
            'run_migrations'      => 'Aja :number migraatio(ta)',
            'no_run_migrations'   => 'Ei avoimia migraatioita',
            'reset_migrations'    => 'Nollaa :number migraatio(ta)',
            'no_reset_migrations' => 'Ei olemassaolevia migraatioita',
        ],
        'avg_query_speed'    => [
            'header' => 'Keskimääräistä kyselyä sekunnissa',
            'unit'   => 'kyselyä sekunnissa',
        ],
        'active_threads'     => [
            'header' => 'Aktiivisia säikeitä',
            'unit'   => 'säikeitä',
        ],
        'open_tables'        => [
            'header' => 'Avoimia taulukkoja',
            'unit'   => 'taulukkoja',
        ],
        'uptime_hours'       => [
            'header' => 'Päälläoloaika tunneissa',
            'unit'   => 'tuntia',
        ],
        'uptime_minutes'     => [
            'header' => 'Päälläoloaika minuuteissa',
            'unit'   => 'minuuttia',
        ],
        'uptime_seconds'     => [
            'header' => 'Päälläoloaika sekunneissa',
            'unit'   => 'sekuntia',
        ],
    ],

];