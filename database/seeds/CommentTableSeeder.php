<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class CommentTableSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'comments';
        $this->csv_delimiter = ',';
        $this->filename = 'database/seeds/csvs/comment_csv.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
