<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Migrations\Migrator;

class MigrationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Pindahkan logika ke register()
    }

    public function register()
    {
        $mainPath = database_path('migrations');
        $directories = [
            $mainPath . '/adminMigrations',
            $mainPath . '/adminMigrations/logAccountMigrations',
            $mainPath . '/adminMigrations/adminAccountMigrations',
            $mainPath . '/factoryAccountManagementMigrations',
            $mainPath . '/userCartManagementMigrations',

            // Tambahkan path subfolder lain yang diinginkan
        ];

        $this->app->extend('migrator', function ($migrator, $app) use ($directories) {
            foreach ($directories as $path) {
                $migrator->path($path);
            }
            
            return $migrator;
        });
    }
}
