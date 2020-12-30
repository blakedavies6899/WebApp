<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Tag;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Post::factory(10)->has(Tag::factory()->count(random_int(0,30)))->create();

    }
}
