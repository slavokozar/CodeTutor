<?php

use Illuminate\Database\Seeder;

use Facades\App\Services\Articles\ArticleService;
use Facades\App\Services\Users\UserService;

use Faker\Factory as Faker;


class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 15; $i++) {

            $authorObj = UserService::findOrFail(rand(1, 3));

            ArticleService::store([
                'name' => $faker->word,
                'description' => $faker->paragraph(),
                'text' => implode(PHP_EOL.PHP_EOL, $faker->paragraphs(10)),
            ], $authorObj);

        }
    }
}
