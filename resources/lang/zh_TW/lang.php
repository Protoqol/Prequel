<?php

    return [

        /*
         * General
         */
        'general'          => [
            'home'       => '首頁',
            'good'       => '好',
            'neutral'    => '中性',
            'critical'   => '危急',
            'warning'    => '警告',
            'migrations' => '遷移行動',
            'length'     => '長度',
            'tables'     => '表',
        ],

        /**
         * components/Pages/PrequelError.vue
         */
        'error_page'       => [
            'oops'               => '哎呀...',
            'tried_connecting'   => '嘗試通過連接',
            'example_connection' => '驅動://用戶@主機名:端口/數據庫名',
            'no_suggestions'     => 'Prequel 無法給出任何修正建議。',
            'disabled'           => 'Prequel 已被禁用。',
        ],

        /**
         * components/Elements/SwitchMode.vue
         */
        'switch_mode'      => [
            'browse' => [
                'title' => '瀏覽模式',
                'text'  => '瀏覽',
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
            'records' => '記錄',
            'buttons' => [
                'dark_mode'   => '暗模式',
                'readability' => '可讀性',
                'side_bar'    => '邊欄',
                'refresh'     => '刷新',
                'get'         => [
                    'title' => '運行查詢 (ENTER)',
                    'text'  => '獲得',
                ],
                'reset'       => [
                    'title' => '重置查詢 (ESC)',
                    'text'  => '重置',
                ],
            ],
        ],

        /**
         * components/MainContent/BrowseMode/Table/Table.vue
         */
        'table'            => [
            'quick_actions' => '快速行動',
            'inspect_row'   => '快速行動',
            'item_empty'    => '這裡什麼都沒有',
            'nothing'       => '這裡什麼都沒有',
        ],

        /**
         * components/MainContent/BrowseMode/Table/TableEmpty.vue
         */
        'table_empty'      => [
            'no_results' => '此查詢未產生任何結果',
            'col_key'    => '列名',
            'col_field'  => '列字段',
            'col_def'    => '列默認值',
            'col_type'   => '列類型',
            'not_set'    => '沒有設置',
        ],

        /**
         * components/MainContent/BrowseMode/Table/TableStatus.vue
         */
        'table_status'     => [
            'loading_data'        => '加載表數據...',
            'error_occurred'      => '加載此表時出錯。請參閱以下內容:',
            'could_not_resolve'   => '無法解決錯誤',
            'prequel_suggestions' => 'Prequel 建議看看以下幾點',
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
            'empty_table' => '此數據庫不包含任何表',
        ],

        /**
         * components/Dashboard/Dashboard.vue
         */
        'dashboard'        => [
            'overview'           => '概况',
            'settings'           => '設置',
            'could_not_retrieve' => '無法檢索...',
            'migrations'         => [
                'run_migrations'      => '運行遷移文件數 :number',
                'no_run_migrations'   => '沒有待定的遷移',
                'reset_migrations'    => '重置遷移數 :number',
                'no_reset_migrations' => '沒有遷移文件',
            ],
            'avg_query_speed'    => [
                'header' => '平均每秒查詢數',
                'unit'   => '每秒查詢次數',
            ],
            'active_threads'     => [
                'header' => '活動線程',
                'unit'   => '線程',
            ],
            'open_tables'        => [
                'header' => '打開表',
                'unit'   => '表',
            ],
            'uptime_hours'       => [
                'header' => '正常運行時間以小時為單位',
                'unit'   => '小時',
            ],
            'uptime_minutes'     => [
                'header' => '正常運行時間以分鐘為單位',
                'unit'   => '分鐘',
            ],
            'uptime_seconds'     => [
                'header' => '正常運行時間以秒為單位',
                'unit'   => '秒',
            ],
        ],

        /**
         * components/MainContent/ManageMode/ManageTable.vue
         */
        'table_management' => [
            'insert_new_row' => '插入新行',
            'view_structure' => '查看結構',
            'run_sql'        => '運行SQL',
            'import'         => '導入',
            'export'         => '導出',
            'log'            => '日誌',
            'settings'       => '設置',
        ],
    ];
