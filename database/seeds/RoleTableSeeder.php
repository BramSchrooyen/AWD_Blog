<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class RoleTableSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function __construct()
    {
        $this->table = 'roles';
        $this->csv_delimiter = ',';
        $this->filename = 'database/seeds/csvs/role_csv.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }
}
