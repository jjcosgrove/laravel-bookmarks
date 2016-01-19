<?php

use Illuminate\Database\Seeder;

class BookmarkTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookmark_tag')->insert([
            'bookmark_id' => 1,
            'tag_id' => 1
        ]);
    }
}
