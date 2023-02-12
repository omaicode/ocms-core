<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Modules\Core\Entities\Admin;
use Omaicode\Permission\Models\Permission;
use Omaicode\Permission\Models\Role;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->createAdmin();
    }

    public function createAdmin()
    {
        $admin = Admin::firstOrCreate([
            'username' => 'administrator',
            'email'    => 'admin@example.com'
        ], [
            'name' => 'Admin',
            'password' => '123456',
            'super_user' => true
        ]);

        $admin->syncRoles(['Super Admin']);
    }
}