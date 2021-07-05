<?php

    return [

        /*
         * General
         */
        'general'          => [
            'home'       => 'Accueil',
            'good'       => 'bon',
            'neutral'    => 'neutre',
            'critical'   => 'critique',
            'warning'    => 'avertissement',
            'migrations' => 'MigrationAction',
            'length'     => 'Longueur',
            'tables'     => 'tables',
        ],

        /**
         * components/Pages/PrequelError.vue
         */
        'error_page'       => [
            'oops'               => 'Oups...',
            'tried_connecting'   => 'J\'ai essayé de me connecter',
            'example_connection' => 'driver://utilisateur@host:port/database',
            'no_suggestions'     => 'Prequel n\'a pas pu suggérer de correctifs.',
            'disabled'           => 'Prequel a été désactivé.',
        ],

        /**
         * components/Elements/SwitchMode.vue
         */
        'switch_mode'      => [
            'browse' => [
                'title' => 'Mode navigation',
                'text'  => 'Parcourir',
            ],
            'manage' => [
                'title' => 'Mode gestion',
                'text'  => 'Gestion',
            ],
        ],

        /**
         * components/Header/Header.vue
         */
        'header'           => [
            'column'  => 'Colonne...',
            'value'   => 'Valeur...',
            'records' => 'enregistrements',
            'buttons' => [
                'dark_mode'   => 'Sombre',
                'readability' => 'Lisibilité',
                'side_bar'    => 'Barre latérale',
                'refresh'     => 'Rafraîchir',
                'get'         => [
                    'title' => 'Exécuter requête (ENTRER)',
                    'text'  => 'Récupérer',
                ],
                'reset'       => [
                    'title' => 'Réinitialiser requête (ESC)',
                    'text'  => 'Réinitialiser',
                ],
            ],
        ],

        /**
         * components/MainContent/BrowseMode/Table/Table.vue
         */
        'table'            => [
            'quick_actions' => 'Actions rapides',
            'inspect_row'   => 'Inspecter la ligne',
            'item_empty'    => 'Rien ici',
            'nothing'       => 'Rien',
        ],

        /**
         * components/MainContent/BrowseMode/Table/TableEmpty.vue
         */
        'table_empty'      => [
            'no_results' => 'Cette requête n\'a donné aucun résultat',
            'col_key'    => 'Clé Colonne',
            'col_field'  => 'Champ Colonne',
            'col_def'    => 'Défaut pour Colonne',
            'col_type'   => 'Type Colonne',
            'not_set'    => 'Pas défini',
        ],

        /**
         * components/MainContent/BrowseMode/Table/TableStatus.vue
         */
        'table_status'     => [
            'loading_data'        => 'Chargement données ... ',
            'error_occurred'      => 'Une erreur s\'est produite lors du chargement de cette table. Détails : ',
            'could_not_resolve'   => 'Impossible de résoudre l\'erreur',
            'prequel_suggestions' => 'Prequel suggère d\'examiner les points suivants',
        ],

        /**
         * components/SideBar/SideBarWrapper.vue
         */
        'side_bar'         => [
            'look_for_table' => 'Recherche tableau...',
        ],

        /**
         * components/SideBar/Menu/TableMenu.vue
         */
        'table_menu'       => [
            'empty_table' => 'Cette base de données ne contient aucune table',
        ],

        /**
         * components/Dashboard/Dashboard.vue
         */
        'dashboard'        => [
            'overview'           => 'Aperçu',
            'settings'           => 'Réglages',
            'could_not_retrieve' => 'Récupération impossible',
            'migrations'         => [
                'run_migrations'      => 'Exécuter :number migration(s)',
                'no_run_migrations'   => 'Aucune migration en attente ',
                'reset_migrations'    => 'Réinitialiser :number migration(s)',
                'no_reset_migrations' => 'Aucune migration existante',
            ],
            'avg_query_speed'    => [
                'header' => 'Moyenne Requêtes/sec.',
                'unit'   => 'requêtes par seconde',
            ],
            'active_threads'     => [
                'header' => 'Processus actifs',
                'unit'   => 'processus',
            ],
            'open_tables'        => [
                'header' => 'Tableaux ouverts ',
                'unit'   => 'tableaux',
            ],
            'uptime_hours'       => [
                'header' => 'Disponibilité en heures ',
                'unit'   => 'heures',
            ],
            'uptime_minutes'     => [
                'header' => 'Disponibilité en minutes',
                'unit'   => 'minutes',
            ],
            'uptime_seconds'     => [
                'header' => 'Disponibilité en secondes',
                'unit'   => 'secondes',
            ],
        ],

        /**
         * components/MainContent/ManageMode/ManageTable.vue
         */
        'table_management' => [
            'insert_new_row' => 'Insérer nouvelle ligne',
            'view_structure' => 'Afficher la structure',
            'run_sql'        => 'Exécuter SQL',
            'import'         => 'Importer',
            'export'         => 'Exportation',
            'log'            => 'Historique',
            'settings'       => 'Réglages',
        ],
    ];
