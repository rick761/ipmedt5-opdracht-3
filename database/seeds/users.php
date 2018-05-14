<?php

use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([[
                'id' => Uuid::generate(),
                'name' => 'admin',
                'email' => 'admin@admin.nl',
                'password' => bcrypt('secret'),
            ],[
                'id' => Uuid::generate(),
                'name' => 'jan',
                'email' => 'jan@jan.nl',
                'password' => bcrypt('secret'),
            ],[
                'id' => Uuid::generate(),
                'name' => 'piet',
                'email' => 'piet@piet.nl',
                'password' => bcrypt('secret'),
            ],[
                'id' => Uuid::generate(),
                'name' => 'henk',
                'email' => 'henk@henk.nl',
                'password' => bcrypt('secret'),
            ],[
                'id' => Uuid::generate(),
                'name' => 'sjaak',
                'email' => 'sjaak@sjaak.nl',
                'password' => bcrypt('secret'),
            ],[
                'id' => Uuid::generate(),
                'name' => 'puk',
                'email' => 'puk@puk.nl',
                'password' => bcrypt('secret'),
            ]

            ]


        );
    }
}
