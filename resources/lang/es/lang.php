<?php


return [

    /*
     * General
     */
    'general'      => [
        'home'       => 'Inicio',
        'good'       => 'bueno',
        'neutral'    => 'neutral',
        'critical'   => 'crítico',
        'warning'    => 'advertencia',
        'migrations' => 'Migraciones',
        'length'     => 'Longitud',
        'tables'     => 'tablas',
    ],

    /**
     * Elements/PrequelError.vue
     */
    'error_page'   => [
        'oops'               => 'Oops...',
        'tried_connecting'   => 'Intentó conectarse a través de',
        'example_connection' => 'connection://user@host:port/database',
        'no_suggestions'     => 'Prequel no pudo sugerir ninguna corrección.',
        'disabled'           => 'Prequel ha sido desactivado.',
    ],

    /**
     * Elements/SwitchMode.vue
     */
    'switch_mode'  => [
        'browse' => [
            'title' => 'Modo de navegación',
            'text'  => 'Navegación',
        ],
        'manage' => [
            'title' => 'Modo administrativo',
            'text'  => 'Administrar',
        ],
    ],

    /**
     * Header/Header.vue
     */
    'header'       => [
        'column'  => 'Columna...',
        'value'   => 'Valor...',
        'records' => 'registros',
        'buttons' => [
            'dark_mode'   => 'Modo Obscuro',
            'readability' => 'Legibilidad',
            'side_bar'    => 'Menu Lateral',
            'get'         => [
                'title' => 'Ejecutar consulta (ENTER)',
                'text'  => 'Ejecutar',
            ],
            'reset'       => [
                'title' => 'Reiniciar consulta (ESC)',
                'text'  => 'Reiniciar',
            ],
        ],
    ],

    /**
     * MainContent/Table/Table.vue
     */
    'table'        => [
        'quick_actions' => 'Acciones Rapidas',
        'inspect_row'   => 'Inspeccionar fila',
        'item_empty'    => 'Éste elemento está vacío',
        'nothing'       => 'No se encontraron registros disponibles en esta tabla',
    ],

    /**
     * MainContent/Table/TableEmpty.vue
     */
    'table_empty'  => [
        'no_results' => 'Esta consulta no obtuvo ningún resultado',
        'col_key'    => 'Clave',
        'col_field'  => 'Campo',
        'col_def'    => 'Valor por defecto',
        'col_type'   => 'Tipo de dato',
        'not_set'    => 'No configurado',
    ],

    /**
     * MainContent/Table/TableStatus.vue
     */
    'table_status' => [
        'loading_data'        => 'Cargando registros...',
        'error_occurred'      => 'Se ha producido un error al cargar esta tabla. Véase lo siguiente:',
        'could_not_resolve'   => 'No se pudo resolver el error',
        'prequel_suggestions' => 'Prequel sugiere tener en cuenta los siguientes puntos',
    ],

    /**
     * SideBar/SideBarWrapper.vue
     */
    'side_bar'     => [
        'look_for_table' => 'Buscar tabla(s)...',
    ],

    /**
     * SideBar/TableMenu.vue
     */
    'table_menu'   => [
        'empty_table' => 'Ésta base de datos, no contiene tablas',
    ],

    /**
     * MainContent/ManageDatabase
     */
    'dashboard'    => [
        'overview'           => 'Resumen',
        'settings'           => 'Configuraciones',
        'could_not_retrieve' => 'Prequel no pudo obtener ésta consulta...',
        'migrations'         => [
            'run_migrations'      => 'Ejecutar :number migracion(es)',
            'no_run_migrations'   => 'Sin migraciones pendientes',
            'reset_migrations'    => 'Reiniciar :number migracion(es)',
            'no_reset_migrations' => 'No existen migraciones',
        ],
        'avg_query_speed'    => [
            'header' => 'Promedio de consultas por segundo',
            'unit'   => 'consultas por segundo',
        ],
        'active_threads'     => [
            'header' => 'Hilos activos',
            'unit'   => 'hilos',
        ],
        'open_tables'        => [
            'header' => 'Tablas Abiertas',
            'unit'   => 'tablas',
        ],
        'uptime_hours'       => [
            'header' => 'Horas en actividad',
            'unit'   => 'horas',
        ],
        'uptime_minutes'     => [
            'header' => 'Minutos en actividad',
            'unit'   => 'minutos',
        ],
        'uptime_seconds'     => [
            'header' => 'Segundos en actividad',
            'unit'   => 'segundos',
        ],
    ],

];
