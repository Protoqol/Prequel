<?php

    return [

        /*
         * General
         */
        'general'          => [
            'home'       => '首页',
            'good'       => '好',
            'neutral'    => '中性',
            'critical'   => '危急',
            'warning'    => '警告',
            'migrations' => '迁移行动',
            'length'     => '长度',
            'tables'     => '表',
        ],

        /**
         * components/Pages/PrequelError.vue
         */
        'error_page'       => [
            'oops'               => '哎呀...',
            'tried_connecting'   => '尝试通过连接',
            'example_connection' => '驱动://用户@主机名:端口/数据库名',
            'no_suggestions'     => 'Prequel 无法给出任何修正建议。',
            'disabled'           => 'Prequel 已被禁用。',
        ],

        /**
         * components/Elements/SwitchMode.vue
         */
        'switch_mode'      => [
            'browse' => [
                'title' => '浏览模式',
                'text'  => '浏览',
            ],
            'manage' => [
                'title' => '管理模式',
                'text'  => '管理',
            ],
        ],

        /**
         * components/Header/Header.vue
         */
        'header'           => [
            'column'  => '列...',
            'value'   => '值...',
            'records' => '记录',
            'buttons' => [
                'dark_mode'   => '暗模式',
                'readability' => '可读性',
                'side_bar'    => '边栏',
                'refresh'     => '刷新',
                'get'         => [
                    'title' => '运行查询 (ENTER)',
                    'text'  => '获得',
                ],
                'reset'       => [
                    'title' => '重置查询 (ESC)',
                    'text'  => '重置',
                ],
            ],
        ],

        /**
         * components/MainContent/BrowseMode/Table/Table.vue
         */
        'table'            => [
            'quick_actions' => '快速行动',
            'inspect_row'   => '检查行',
            'item_empty'    => '这里什么都没有',
            'nothing'       => '这里什么都没有',
        ],

        /**
         * components/MainContent/BrowseMode/Table/TableEmpty.vue
         */
        'table_empty'      => [
            'no_results' => '此查询未产生任何结果',
            'col_key'    => '列名',
            'col_field'  => '列字段',
            'col_def'    => '列默认值',
            'col_type'   => '列类型',
            'not_set'    => '没有设置',
        ],

        /**
         * components/MainContent/BrowseMode/Table/TableStatus.vue
         */
        'table_status'     => [
            'loading_data'        => '加载表数据...',
            'error_occurred'      => '加载此表时出错。请参阅以下内容:',
            'could_not_resolve'   => '无法解决错误',
            'prequel_suggestions' => 'Prequel 建议看看以下几点',
        ],

        /**
         * components/SideBar/SideBarWrapper.vue
         */
        'side_bar'         => [
            'look_for_table' => '查找表...',
        ],

        /**
         * components/SideBar/Menu/TableMenu.vue
         */
        'table_menu'       => [
            'empty_table' => '此数据库不包含任何表',
        ],

        /**
         * components/Dashboard/Dashboard.vue
         */
        'dashboard'        => [
            'overview'           => '概况',
            'settings'           => '设置',
            'could_not_retrieve' => '无法检索...',
            'migrations'         => [
                'run_migrations'      => '运行迁移文件数 :number',
                'no_run_migrations'   => '没有待定的迁移',
                'reset_migrations'    => '重置迁移数 :number',
                'no_reset_migrations' => '没有迁移文件',
            ],
            'avg_query_speed'    => [
                'header' => '平均每秒查询数',
                'unit'   => '每秒查询次数',
            ],
            'active_threads'     => [
                'header' => '活动线程',
                'unit'   => '线程',
            ],
            'open_tables'        => [
                'header' => '打开表',
                'unit'   => '表',
            ],
            'uptime_hours'       => [
                'header' => '正常运行时间以小时为单位',
                'unit'   => '小时',
            ],
            'uptime_minutes'     => [
                'header' => '正常运行时间以分钟为单位',
                'unit'   => '分钟',
            ],
            'uptime_seconds'     => [
                'header' => '正常运行时间以秒为单位',
                'unit'   => '秒',
            ],
        ],

        /**
         * components/MainContent/ManageMode/ManageTable.vue
         */
        'table_management' => [
            'insert_new_row' => '插入新行',
            'view_structure' => '查看结构',
            'run_sql'        => '运行SQL',
            'import'         => '导入',
            'export'         => '导出',
            'log'            => '日志',
            'settings'       => '设置',
        ],
    ];
