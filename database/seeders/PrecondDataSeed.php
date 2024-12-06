<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrecondDataSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category1 = Category::factory()->create([]);
        $category2 = Category::factory()->create([]);
        $category3 = Category::factory()->create([]);
        $category4 = Category::factory()->create([]);

        $categoryIds = [$category1->id, $category2->id, $category3->id, $category4->id];

        $author1 = Author::factory()->create([]);
        $author2 = Author::factory()->create([]);
        $author3 = Author::factory()->create([]);
        $author4 = Author::factory()->create([]);

        $authorIds = [$author1->id, $author2->id, $author3->id, $author4->id];

        for ($i = 1; $i <= 500; $i++) {
            Book::factory()->create([
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'author_id' => $authorIds[array_rand($authorIds)]
            ]);
        }
    }
}
