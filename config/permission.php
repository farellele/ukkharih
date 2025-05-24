<?php

return [

    'models' => [

        /*
         * Model yang digunakan untuk menyimpan daftar izin.
         */
        'permission' => Spatie\Permission\Models\Permission::class,

        /*
         * Model yang digunakan untuk menyimpan daftar peran pengguna.
         */
        'role' => Spatie\Permission\Models\Role::class,

    ],

    'table_names' => [

        /*
         * Tabel untuk menyimpan peran pengguna.
         */
        'roles' => 'roles',

        /*
         * Tabel untuk menyimpan izin.
         */
        'permissions' => 'permissions',

        /*
         * Tabel pivot yang menghubungkan model pengguna dengan izin.
         * Menggunakan model polymorphic Laravel untuk mendukung berbagai jenis model.
         */
        'model_has_permissions' => 'model_has_permissions',

        /*
         * Tabel pivot yang menghubungkan model pengguna dengan peran.
         */
        'model_has_roles' => 'model_has_roles',

        /*
         * Tabel pivot yang menghubungkan peran dengan izin.
         */
        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        /*
         * Jika menggunakan UUID atau kunci utama yang berbeda, sesuaikan nilai ini.
         */
        'role_pivot_key' => 'role_id',
        'permission_pivot_key' => 'permission_id',

        /*
         * Nama kolom untuk menyimpan model polymorphic, memungkinkan fleksibilitas dalam model lain.
         */
        'model_morph_key' => 'model_id',

        /*
         * Jika menggunakan fitur teams, ini adalah kunci asing tim yang digunakan dalam tabel terkait.
         */
        'team_foreign_key' => 'team_id',
    ],

    /*
     * Konfigurasi untuk metode pengecekan izin di Laravel gate.
     */
    'register_permission_check_method' => true,

    /*
     * Mengaktifkan event Laravel Octane untuk reset cache permissions.
     */
    'register_octane_reset_listener' => false,

    /*
     * Mengaktifkan event saat izin atau peran ditambahkan atau dihapus.
     */
    'events_enabled' => true,

    /*
     * Fitur teams untuk mengelola izin dalam lingkungan multi-tenant.
     */
    'teams' => false,

    /*
     * Resolver untuk mengelola izin berdasarkan tim.
     */
    'team_resolver' => \Spatie\Permission\DefaultTeamResolver::class,

    /*
     * Menggunakan client credentials dari Laravel Passport untuk autentikasi.
     */
    'use_passport_client_credentials' => false,

    /*
     * Menampilkan nama izin dalam pengecualian jika terjadi kesalahan.
     */
    'display_permission_in_exception' => true,

    /*
     * Menampilkan nama peran dalam pengecualian jika terjadi kesalahan.
     */
    'display_role_in_exception' => false,

    /*
     * Mengaktifkan pencarian izin wildcard, misalnya `view-*` untuk semua tampilan.
     */
    'enable_wildcard_permission' => true,

    /* Cache-specific settings */

    'cache' => [

        /*
         * Default, cache permissions disimpan selama 24 jam untuk meningkatkan performa.
         */
        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * Kunci cache yang digunakan untuk menyimpan daftar izin.
         */
        'key' => 'spatie.permission.cache',

        /*
         * Tentukan penyimpanan cache yang digunakan, default mengikuti pengaturan Laravel.
         */
        'store' => 'default',
    ],
];
