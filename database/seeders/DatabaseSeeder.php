<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            RolesTableSeeder::class,
            //PermissionsTableSeeder::class,
            //RoleHasPermissionsTableSeeder::class,
            //ModelHasPermissionsTableSeeder::class,
            //ModelHasRolesTableSeeder::class,

        ]);
    }
    
    
    
}
