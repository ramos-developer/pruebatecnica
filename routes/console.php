<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('init-database {withSeed}', function ($withSeed = null){

    DB::statement('create database if not exists ' . env('DB_DATABASE'));
    DB::statement('create database if not exists ' . env('DB_DATABASE_AUX'));
    Config::set('database.connections.mysql.database', env('DB_DATABASE_AUX'));
    DB::reconnect('mysql');

    $this->info('Borrando base de datos "' . env('DB_DATABASE') . '"');
    DB::statement('drop database IF EXISTS ' . env('DB_DATABASE') . '');

    $this->info('Creando base de datos "' . env('DB_DATABASE') . '"');
    DB::statement('create database ' . env('DB_DATABASE') . '');

    $this->info('Migrando base de datos "' . env('DB_DATABASE') . '"');
    Config::set('database.connections.mysql.database', env('DB_DATABASE'));
    DB::reconnect('mysql');

    $this->call('migrate', ['--path' => '/vendor/bloondeweb/usersandprivileges/database/migrations']);
    $this->info('Migradas tablas del paquete de usuarios y privilegios');

    $this->call('migrate', ['--path' => '/vendor/bloondeweb/citiesstatesandnationalities/database/migrations']);
    $this->info('Migradas tablas del paquete de provincias y ciudades');

    $this->call('migrate');
    $this->info('Migradas tablas del core');

    if($withSeed) {
        $this->call('db:seed', ['--class' => 'Bloonde\CitiesStatesAndNationalities\Database\Seeds\CitiesStatesAndNationalitiesDatabaseSeeder']);
        $this->call('db:seed', ['--class' => 'DatabaseSeeder']);
    }

});
