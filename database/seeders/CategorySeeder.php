<?php

namespace Database\Seeders;

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
        for($i=0; $i<random_int(10, 15); $i++) {
            $category = \App\Models\Category::factory()->create();

            for($j=0; $j<random_int(10, 15); $j++) {
                $post = \App\Models\Post::factory()->create([
                    'category_id' => $category->id
                ]);

                \App\Models\Comment::factory(10)->create([
                    'post_id' => $post->id
                ]);
            }
        };
    }
}
