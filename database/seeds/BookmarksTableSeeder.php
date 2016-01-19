<?php

use Illuminate\Database\Seeder;

class BookmarksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookmarks')->insert([
            'name' => 'Bookmarks on GitHub',
            'url' => 'https://github.com/jjcosgrove/laravel-bookmarks',
            'private' => true,
            'user_id' => 1
        ]);
    }
}
