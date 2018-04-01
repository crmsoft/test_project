<?php

use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class,1)->create();
        factory(\App\Company::class,rand(12,30))->create()->each(function ($company){
            factory(\App\Employee::class,rand(5,268))->make()->each(function($employee) use ($company){
                $employee->company()->associate($company);
                $employee->save();
            });
        });
    }
}
