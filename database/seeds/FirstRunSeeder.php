<?php

use Illuminate\Database\Seeder;

class FirstRunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_user')->insert([
            0 => [
              'username' => 'admin',
              'password' => 'admin',
              'level'    => 2
            ],
            1 => [
              'username' => 'user',
              'password' => 'user',
              'level'    => 1
            ],
        ]);

        DB::table('tbl_menu')->insert([
            'nama_menu'  => 'Pisang Goreng',
            'harga'      => 20000
        ]);
    }
}
