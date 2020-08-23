<?php

use Illuminate\Database\Seeder;
use App\Article;
class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // remove old records
        Article::truncate();

        //create a faker
        $faker = \Faker\Factory::create();

        // create some article
        for ($i = 0; $i < 50; $i++){
            Article::create([
                'title' => $faker->sentence(),
                'body' => $faker->paragraph()
            ]);
        }
    }
}
