<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PostsTableSeeder;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //    $this->call(PostsTableSeeder::class);
    
       Post::factory(100)->create();
    //    Post::factory(100)->create([
    //     'body' => 'Overridding the body of post.'
    //    ]);
    }
}
