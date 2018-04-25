<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lvl1 = factory(App\Employee::class)->create();
        $lvl2 = factory(App\Employee::class, 10)->create(['parent_id' => $lvl1->id]);
        $lvl3 = factory(App\Employee::class, 100)
            ->create()
            ->each(function($employee) use ($lvl2) {
                $employee->parent_id = $lvl2->random()->id;
                $employee->save();
        });
        $lvl4 = factory(App\Employee::class, 1000)
            ->create()
            ->each(function($employee) use ($lvl3) {
                $employee->parent_id = $lvl3->random()->id;
                $employee->save();
        });
        $lvl5 = factory(App\Employee::class, 50)
            ->create()
            ->each(function($employee) use ($lvl4) {
                $employee->parent_id = $lvl4->random()->id;
                $employee->save();
        });
    }
}
