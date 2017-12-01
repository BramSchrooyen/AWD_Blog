<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class BlogTableSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'blogs';
        $this->csv_delimiter = ',';
        $this->filename = 'database/seeds/csvs/blog_csv.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
