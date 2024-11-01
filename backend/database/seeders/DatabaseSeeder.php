<?php

namespace Database\Seeders;

use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i=0; $i < 100; $i++) {
            $user = User::factory()->create();
            $post = Post::factory()->for($user)->hasAttached(Tag::factory(1))->create();

            $userForCommentOne = User::factory()->create();
            Comment::factory()->for($userForCommentOne)->for($post)->create();
            $userForCommentTwo = User::factory()->create();
            Comment::factory()->for($userForCommentTwo)->for($post)->create();
        }
    }
}
