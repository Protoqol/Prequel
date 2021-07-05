<?php

return [

    /**
     * General
     */
    'general'      => [
        'home'       => 'Início',
        'good'       => 'bom',
        'neutral'    => 'neutro',
        'critical'   => 'crítico',
        'warning'    => 'aviso',
        'migrations' => 'migrações',
        'length'     => 'comprimento',
        'tables'     => 'tabelas',
    ],

    /**
     * Elements/PrequelError.vue
     */
    'error_page'   => [
        'oops'               => 'Oops...',
        'tried_connecting'   => 'tentou conectar através de',
        'example_connection' => 'conexao://usuario@servidor:porta/bancodedados',
        'no_suggestions'     => 'Prequel não pode sugerir nenhuma correção.',
        'disabled'           => 'Prequel foi desabilitado.',
    ],

    /**
     * Elements/SwitchMode.vue
     */
    'switch_mode'  => [
        'browse' => [
            'title' => 'Modo de navegação',
            'text'  => 'Navegar',
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
        'column'  => 'Coluna...',
        'value'   => 'Valor...',
        'records' => 'registros',
        'buttons' => [
            'dark_mode'   => 'Modo escuro',
            'readability' => 'Legibilidade',
            'side_bar'    => 'Barra Lateral',
            'refresh'     => 'Recarregar',
            'get'         => [
                'title' => 'Executar Consulta (ENTER)',
                'text'  => 'Pegar',
            ],
            'reset'       => [
                'title' => 'Resetar consulta (ESC)',
                'text'  => 'Resetar',
            ],
        ],
    ],

    /**
     * MainContent/Table/Table.vue
     */
    'table'        => [
        'quick_actions' => 'Ações rápidas',
        'inspect_row'   => 'Inspecionar linha',
        'item_empty'    => 'Este item está vazio',
        'nothing'       => 'Nada aqui',
    ],

    /**
     * MainContent/Table/TableEmpty.vue
     */
    'table_empty'  => [
        'no_results' => 'Esta consulta não retornou nenhum resultado',
        'col_key'    => 'Coluna chave',
        'col_field'  => 'Campo da coluna',
        'col_def'    => 'Coluna padrão',
        'col_type'   => 'Tipo de coluna',
        'not_set'    => 'Não definido',
    ],

    /**
     * MainContent/Table/TableStatus.vue
     */
    'table_status' => [
        'loading_data'        => 'Carregando dados da tabela...',
        'error_occurred'      => 'Houve um erro ao carregar esta tabela. Veja o seguinte:',
        'could_not_resolve'   => 'Não foi possível resolver o erro',
        'prequel_suggestions' => 'Prequel sugere olhar os seguinte pontos',
    ],

    /**
     * SideBar/SideBarWrapper.vue
     */
    'side_bar'     => [
        'look_for_table' => 'Procure a tabela...',
    ],

    /**
     * SideBar/TableMenu.vue
     */
    'table_menu'   => [
        'empty_table' => 'Este banco de dados não contém nenhuma tabela',
    ],

    /**
     * MainContent/ManageDatabase
     */
    'dashboard'    => [
        'overview'           => 'Visão geral',
        'settings'           => 'Ajustes',
        'could_not_retrieve' => 'Não foi possível recuperar isto...',
        'migrations'         => [
            'run_migrations'      => 'Executar :número migração(ões)',
            'no_run_migrations'   => 'Sem migrações pendentes',
            'reset_migrations'    => 'Resetar :número migração(ões)',
            'no_reset_migrations' => 'Não existem migrações',
        ],
        'avg_query_speed'    => [
            'header' => 'Média de consultas por segundo',
            'unit'   => 'consultas por segundo',
        ],
        'active_threads'     => [
            'header' => 'Threads ativos',
            'unit'   => 'threads',
        ],
        'open_tables'        => [
            'header' => 'Tabelas abertas',
            'unit'   => 'tabelas',
        ],
        'uptime_hours'       => [
            'header' => 'Tempo ativo em horas',
            'unit'   => 'horas',
        ],
        'uptime_minutes'     => [
            'header' => 'Tempo ativo em minutos',
            'unit'   => 'minutos',
        ],
        'uptime_seconds'     => [
            'header' => 'Tempo ativo em segundos',
            'unit'   => 'segundos',
        ],
    ],

    /**
     * components/MainContent/ManageMode/ManageTable.vue
     */
    'table_management' => [
        'insert_new_row' => 'Inserir Nova Linha',
        'view_structure' => 'Ver Estrutura',
        'run_sql'        => 'Executar SQL',
        'import'         => 'Importar',
        'export'         => 'Exportar',
        'log'            => 'Log',
        'settings'       => 'Configurações',
    ],
];
