<?php

use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('abilities')->insert(
            [
                [
                    'name' => 'all_edit_articles',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'all_delete_articles',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'own_edit_articles',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'own_delete_articles',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'all_read_articles',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'own_read_articles',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'publish_articles',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'manage_roles',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'read_only_roles',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'manage_users',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ],
                [
                    'name' => 'read_only_users',
                    'created_at' => NOW(),
                    'updated_at' => NOW()
                ]
            ]
        );
    }
}
