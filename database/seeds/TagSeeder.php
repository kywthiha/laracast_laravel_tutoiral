<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert(
            [
                [
                    'name' => 'laravel',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'php',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'education',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'java',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'mysql',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'javascript',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ]
            ]
        );
    }
}
