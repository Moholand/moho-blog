<?php

namespace Database\Seeders;

use App\Models\Reply;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First create between 10 to 15 fake categories
        // Then for each category create between 5 to 10 fake posts
        // Then for each post create between 1 to 5 fake comments
        // Then for each comment create 2 replies

        for($i=0; $i<random_int(10, 15); $i++) {
            $category = \App\Models\Category::factory()->create();

            for($j=0; $j<random_int(5, 10); $j++) {
                $post = \App\Models\Post::factory()->create([
                    'category_id' => $category->id
                ]);

                for($k=0; $k<random_int(1, 5); $k++) {
                    $comment = \App\Models\Comment::factory()->create([
                        'post_id' => $post->id
                    ]);

                    \App\Models\Reply::factory(2)->create([
                        'comment_id' => $comment->id
                    ]);
                }
            }
        };
    }
}
