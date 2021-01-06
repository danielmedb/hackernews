<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\support\DB;
use Illuminate\support\Facades\Str;
use App\Models\Post;
use App\Models\User;
use App\Models\Vote;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();

        $user = User::factory(100)
            ->has(Post::factory()->count(1))
            ->has(Comment::factory()->count(1))
            ->has(Vote::factory()->count(1))
            ->create();
    }
}
