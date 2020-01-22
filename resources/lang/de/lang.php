<?php
    
    return [
        
        /*
         * General
         */
        'general'          => [
            'home'       => 'Start',
            'good'       => 'gut',
            'neutral'    => 'neutral',
            'critical'   => 'kritisch',
            'warning'    => 'Warnung',
            'migrations' => 'MigrationAction',
            'length'     => 'Länge',
            'tables'     => 'Tabellen',
        ],
        
        /**
         * components/Pages/PrequelError.vue
         */
        'error_page'       => [
            'oops'               => 'Oops...',
            'tried_connecting'   => 'Verbindung hat nicht funktioniert.',
            'example_connection' => 'driver://user@host:port/database',
            'no_suggestions'     => 'Prequel konnte keine Lösungsvorschläge machen.',
            'disabled'           => 'Prequel wurde deaktiviert.',
        ],
        
        /**
         * components/Elements/SwitchMode.vue
         */
        'switch_mode'      => [
            'browse' => [
                'title' => 'Durchsuchen',
                'text'  => 'Durchsuchen',
            ],
            'manage' => [
                'title' => 'Verwalten',
                'text'  => 'Verwalten',
            ],
        ],
        
        /**
         * components/Header/Header.vue
         */
        'header'           => [
            'column'  => 'Spalte...',
            'value'   => 'Wert...',
            'records' => 'Einträge',
            'buttons' => [
                'dark_mode'   => 'Nachtmodus',
                'readability' => 'Lesbarkeit',
                'side_bar'    => 'Sidebar',
                'refresh'     => 'Aktualisieren',
                'get'         => [
                    'title' => 'Query ausführen (ENTER)',
                    'text'  => 'Ausführen',
                ],
                'reset'       => [
                    'title' => 'Query zurücksetzen (ESC)',
                    'text'  => 'Zurücksetzen',
                ],
            ],
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/Table.vue
         */
        'table'            => [
            'quick_actions' => 'Schnellzugriffe',
            'inspect_row'   => 'Zeile inspizieren',
            'item_empty'    => 'Keine Daten',
            'nothing'       => 'Keine Daten',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableEmpty.vue
         */
        'table_empty'      => [
            'no_results' => 'Diese Anfrage hat keine Ergebnisse zurückgeliefert.',
            'col_key'    => 'Spaltenschlüssel',
            'col_field'  => 'Spaltenfeld',
            'col_def'    => 'Spaltenstandard',
            'col_type'   => 'Spaltentyp',
            'not_set'    => 'Nicht gesetzt',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableStatus.vue
         */
        'table_status'     => [
            'loading_data'        => 'Lade Daten...',
            'error_occurred'      => 'Beim Abrufen der Daten ist ein Fehler aufgetreten. Beachten Sie folgende Hinweise:',
            'could_not_resolve'   => 'Anfrage konnte nicht aufgelöst werden',
            'prequel_suggestions' => 'Prequel empfiehlt, noch einmal an folgenden Stellen nachzusehen:',
        ],
        
        /**
         * components/SideBar/SideBarWrapper.vue
         */
        'side_bar'         => [
            'look_for_table' => 'Tabelle suchen...',
        ],
        
        /**
         * components/SideBar/Menu/TableMenu.vue
         */
        'table_menu'       => [
            'empty_table' => 'Diese Datenbank enthält keine Tabellen',
        ],
        
        /**
         * components/Dashboard/Dashboard.vue
         */
        'dashboard'        => [
            'overview'           => 'Übersicht',
            'settings'           => 'Einstellungen',
            'could_not_retrieve' => 'Konnte nicht abgerufen werden...',
            'migrations'         => [
                'run_migrations'      => ':number Migration(en) ausführen',
                'no_run_migrations'   => 'Keine ausstehenden Migrationen',
                'reset_migrations'    => ':number Migration(en) zurücksetzen',
                'no_reset_migrations' => 'Es existieren keine Migrationen',
            ],
            'avg_query_speed'    => [
                'header' => 'Durchschn. Abfragen pro Sekunde',
                'unit'   => 'Abfragen pro Sekunde',
            ],
            'active_threads'     => [
                'header' => 'Aktive Threads',
                'unit'   => 'Threads',
            ],
            'open_tables'        => [
                'header' => 'Geöffnete Tabellen',
                'unit'   => 'Tabellen',
            ],
            'uptime_hours'       => [
                'header' => 'Laufzeit in Stunden',
                'unit'   => 'Stunden',
            ],
            'uptime_minutes'     => [
                'header' => 'Laufzeit in Minuten',
                'unit'   => 'Minuten',
            ],
            'uptime_seconds'     => [
                'header' => 'Laufzeit in Sekunden',
                'unit'   => 'Sekunden',
            ],
        ],
        
        /**
         * components/MainContent/ManageMode/ManageTable.vue
         */
        'table_management' => [
            'insert_new_row' => 'Neue Zeile einfügen',
            'view_structure' => 'Struktur ansehen',
            'run_sql'        => 'SQL ausführen',
            'import'         => 'Importieren',
            'export'         => 'Exportieren',
            'log'            => 'Log',
            'settings'       => 'Einstellungen',
        ],
    ];
