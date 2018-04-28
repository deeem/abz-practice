<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EmployeeTest extends TestCase
{
    use DatabaseMigrations;

    protected $employee;

    protected function setUp()
    {
        parent::setUp();
        $this->actingAs(factory('App\User')->create());
        $this->employee = factory('App\Employee')->create();
    }

    /**
     * @test
     */
    public function canStoreEmployee()
    {
        $employee = ['name' => 'John', 'position' => 'worker', 'hired' => \Carbon\Carbon::now(), 'salary' => 1000];

        $this->post('/employee', $employee);

        $this->assertDatabaseHas(
            'employees',
            ['name' => 'John', 'salary' => 1000]
        );
    }

    /**
     * @test
     */
    public function canUpdateEmployee()
    {
        $jane = ['name' => 'Jane', 'position' => 'worker', 'hired' => \Carbon\Carbon::now(), 'salary' => 1000];
        $this->put("/employee/{$this->employee->id}", $jane);

        $this->assertDatabaseHas(
            'employees',
            ['id' => $this->employee->id, 'name' => 'Jane']
        );
    }

    /**
     * @test
     */
    public function canDestroyEmployee()
    {
        $this->delete("/employee/{$this->employee->id}");

        $this->assertDatabaseMissing(
            'employees',
            ['id' => $this->employee->id, 'name' => $this->employee->name]
        );
    }

    /**
     * @test
     */
    public function canValidateGame()
    {
        $this->post('/employee', ['name' => null])
            ->assertSessionHasErrors('name');

        $this->post('/employee/store', ['position' => null])
            ->assertSessionHasErrors('position');

        $this->post('/employee/store', ['hired' => null])
            ->assertSessionHasErrors('hired');

        $this->post('/employee/store', ['salary' => null])
            ->assertSessionHasErrors('salary');

        $this->put("/employee/{$this->employee->id}", ['name' => null])
            ->assertSessionHasErrors('name');

        $this->put("/employee/{$this->employee->id}", ['position' => null])
            ->assertSessionHasErrors('position');

        $this->put("/employee/{$this->employee->id}", ['hired' => null])
            ->assertSessionHasErrors('hired');

        $this->put("/employee/{$this->employee->id}", ['salary' => null])
            ->assertSessionHasErrors('salary');
    }

    /**
     * @test
     */
    public function canBrowseEmployeeResources()
    {
        $this->get('/employee')->assertStatus(200);
        $this->get('/employee/create')->assertStatus(200);
        $this->get("/employee/{$this->employee->id}/edit")->assertStatus(200);
    }

    /**
     * @test
     */
    public function guestCanNotParticipateEmployees()
    {
        auth()->logout();
        $this->get('/employee')->assertRedirect('/login');
        $this->get("/employee/{$this->employee->id}/edit")->assertRedirect('/login');
        $this->put("/employee/{$this->employee->id}")->assertRedirect('/login');
        $this->delete("/employee/{$this->employee->id}")->assertRedirect('/login');
    }
}
