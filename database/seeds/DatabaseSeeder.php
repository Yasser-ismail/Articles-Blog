<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('roles')->truncate();

        factory(App\Models\User::class, 25)->create()->each(function ($user){
            $user->posts()->save(factory(App\Models\Post::class)->make());
        });

        factory(App\Models\Comment::class, 50)->create();
        factory(App\Models\Role::class, 2)->create();


    }
}
