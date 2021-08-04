<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'email' => 'admin@gmail.com',
            'name' => 'Admin Admin',
            'password' => Hash::make('123'),
        ]);
        $permissions = [
            'read_users','create_users','edit_users','delete_users',
            'read_drugs','create_drugs','edit_drugs','delete_drugs',
            'dispense_drugs','read_dispense_drugs'
        ];
        foreach($permissions as $permission){
            $per = Permission::create([
                'name' =>$permission
            ]);
            UserPermission::create([
                'user_id' => $super_admin->id,
                'permission_id' => $per->id,
            ]);
        }
    }
}
