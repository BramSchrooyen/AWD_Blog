<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class TagTableSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'tags';
        $this->csv_delimiter = ',';
        $this->filename = 'database/seeds/csvs/tag_csv.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}