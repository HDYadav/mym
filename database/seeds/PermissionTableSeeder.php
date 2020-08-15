<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
        {
            $user = User::create([
                'name' => 'Rahul Shukla',
                'email' => 'admin@rscoder.com',
                'password' => bcrypt('123456')
                ]);
                $role = Role::create(['name' => 'Admin']);
                $permissions = Permission::pluck('id','id')->all();
                $role->syncPermissions($permissions);
                $user->assignRole([$role->id]);
        }
         
}
