<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->table = 'users';
        $this->csv_delimiter = ',';
        $this->filename = 'database/seeds/csvs/user_csv.csv';
    }

    public function run()
    {
        DB::disableQueryLog();
        DB::table($this->table)->truncate();
        parent::run();
    }*/

    //Tutorial gevolgd op: https://medium.com/@ezp127/laravel-5-4-native-user-authentication-role-authorization-3dbae4049c8a

    public function run(){
        DB::disableQueryLog();
        DB::table('users')->truncate();
        $role_user = Role::where('name','user')->first();
        $role_admin = Role::where('name','admin')->first();

        $user = new User();
        $user->name = 'Gebruiker';
        $user->email = 'gebruiker@gebruiker.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_admin);


    }
}
