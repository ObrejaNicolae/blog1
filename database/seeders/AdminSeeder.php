<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    private $permision =[
        'role-list',
        'role-create',
        'role-edit',
        'role-delete',
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->permision as $permission){
            Permission::create(['name'=>$permission]);
        }
        $user = User::create([
            'name'=>'Strelciuc Dan',
            'email'=>'dadmin@admin.com',
            'password'=>Hash::make('dAdmin24')
        ]);

        $role =Role::create(['name'=>'Admin']);
        $permission = Permission::pluck('id','id')->all();
        $role->asyncPermissions($permission);
        $user->assignRole([$role->id]);
    }
}
