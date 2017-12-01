<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BlogTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(CommentTableSeeder::class);
    }
}
