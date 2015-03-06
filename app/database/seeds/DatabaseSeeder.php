<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('UserTableSeeder');
        $this->call('LevelTableSeeder');
        $this->call('StateTableSeeder');
        $this->call('StudentTableSeeder');
        $this->call('StudentStateTableSeeder');
        $this->call('CourseTableSeeder');
        $this->call('ResultTableSeeder');
        $this->call('GpaTableSeeder');
	}

}
