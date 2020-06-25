<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                [
                    'name' => 'admin',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'standard',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'guest',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ]
            ]
        );
    }
}
