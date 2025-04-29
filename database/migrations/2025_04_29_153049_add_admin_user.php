<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AddAdminUser extends Migration
{
    public function up()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@softec.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'status' => 'approved', // Si tienes un campo status
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        DB::table('users')->where('email', 'admin@tuempresa.com')->delete();
    }
}