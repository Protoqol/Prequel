<?php
    
    return [
        
        /*
         * General
         */
        'general'          => [
            'home'       => 'Beranda',
            'good'       => 'baik',
            'neutral'    => 'netral',
            'critical'   => 'kritis',
            'warning'    => 'peringatan',
            'migrations' => 'AksiMigrasi',
            'length'     => 'Panjang',
            'tables'     => 'tabel-tabel',
        ],
        
        /**
         * components/Pages/PrequelError.vue
         */
        'error_page'       => [
            'oops'               => 'Ups...',
            'tried_connecting'   => 'Mencoba koneksi melalui',
            'example_connection' => 'driver://user@host:port/database',
            'no_suggestions'     => 'Prequel tidak dapat memberikan saran perbaikan.',
            'disabled'           => 'Prequel telah dinonaktifkan.',
        ],
        
        /**
         * components/Elements/SwitchMode.vue
         */
        'switch_mode'      => [
            'browse' => [
                'title' => 'Mode penelusuran',
                'text'  => 'Penelusuran',
            ],
            'manage' => [
                'title' => 'Mode pengaturan',
                'text'  => 'Pengaturan',
            ],
        ],
        
        /**
         * components/Header/Header.vue
         */
        'header'           => [
            'column'  => 'Kolom...',
            'value'   => 'Nilai...',
            'records' => 'catatan',
            'buttons' => [
                'dark_mode'   => 'Mode Gelap',
                'readability' => 'Kemudahan pembacaan',
                'side_bar'    => 'Bar Samping',
                'refresh'     => 'Penyegaran',
                'get'         => [
                    'title' => 'Jalankan query (ENTER)',
                    'text'  => 'Ambil',
                ],
                'reset'       => [
                    'title' => 'Atur ulang query (ESC)',
                    'text'  => 'Atur Ulang',
                ],
            ],
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/Table.vue
         */
        'table'            => [
            'quick_actions' => 'Aksi cepat',
            'inspect_row'   => 'Periksa baris',
            'item_empty'    => 'Kosong',
            'nothing'       => 'Kosong',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableEmpty.vue
         */
        'table_empty'      => [
            'no_results' => 'Query ini tidak memberikan hasil',
            'col_key'    => 'Kolom Kunci',
            'col_field'  => 'Kolom Field',
            'col_def'    => 'Nilai Default',
            'col_type'   => 'Jenis Kolom',
            'not_set'    => 'Belum Diatur',
        ],
        
        /**
         * components/MainContent/BrowseMode/Table/TableStatus.vue
         */
        'table_status'     => [
            'loading_data'        => 'Mengambil data tabel...',
            'error_occurred'      => 'Terjadi kesalahan ketika mengambil data. Lihat keterangan berikut:',
            'could_not_resolve'   => 'Tidak dapat memperbaiki kesalahan',
            'prequel_suggestions' => 'Prequel menyarankan untuk memeriksa poin-poin berikut',
        ],
        
        /**
         * components/SideBar/SideBarWrapper.vue
         */
        'side_bar'         => [
            'look_for_table' => 'Membaca tabel...',
        ],
        
        /**
         * components/SideBar/Menu/TableMenu.vue
         */
        'table_menu'       => [
            'empty_table' => 'Database ini tidak memiliki tabel',
        ],
        
        /**
         * components/Dashboard/Dashboard.vue
         */
        'dashboard'        => [
            'overview'           => 'Tampilan Umum',
            'settings'           => 'Pengaturan',
            'could_not_retrieve' => 'Gagal melakukan pengambilan...',
            'migrations'         => [
                'run_migrations'      => 'Telah menjalankan :number migrasi',
                'no_run_migrations'   => 'Tidak ada migrasi menunggu',
                'reset_migrations'    => 'Mengatur ulang :number migrasi',
                'no_reset_migrations' => 'Tidak ada migrasi',
            ],
            'avg_query_speed'    => [
                'header' => 'Rata-rata query per detik',
                'unit'   => 'query per detik',
            ],
            'active_threads'     => [
                'header' => 'Thread Aktif',
                'unit'   => 'thread',
            ],
            'open_tables'        => [
                'header' => 'Table dibuka',
                'unit'   => 'tabel',
            ],
            'uptime_hours'       => [
                'header' => 'Jumlah jam aktif',
                'unit'   => 'jam',
            ],
            'uptime_minutes'     => [
                'header' => 'Jumlah menit aktif',
                'unit'   => 'menit',
            ],
            'uptime_seconds'     => [
                'header' => 'Jumlah detik aktif',
                'unit'   => 'detik',
            ],
        ],
        
        /**
         * components/MainContent/ManageMode/ManageTable.vue
         */
        'table_management' => [
            'insert_new_row' => 'Tambahkan Baris Baru',
            'view_structure' => 'Tampilkan Struktur',
            'run_sql'        => 'Jalankan SQL',
            'import'         => 'Import',
            'export'         => 'Export',
            'log'            => 'Catatan',
            'settings'       => 'Pengaturan',
        ],
    ];
