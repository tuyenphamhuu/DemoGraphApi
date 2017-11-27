<?php

use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(DataUserTestSeeder::class);
    }
}
class UsersTableSeeder()
{
	public function run()
	{

	}
}
