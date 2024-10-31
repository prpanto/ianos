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
        User::factory()
            ->count(100)
            ->has(Post::factory(rand(3, 5))
                ->count(1)
                ->hasAttached(Tag::factory()->count(1))
                ->has(Comment::factory()->count(rand(5, 10)))
            )
            ->create();
    }
}
