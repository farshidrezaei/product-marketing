<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class InitAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(): void
    {
        Model::unguard();


        $superAdminUser = User::create(
            [
                'name' => 'Farshid Rezaei',
                'email' => 'farshid@gmail.com',
                'password' => 'password',
            ]
        );

        $superAdminRole = Role::create(['name' => 'super-admin']);

        $superAdminUser->assignRole($superAdminRole);
    }
}
