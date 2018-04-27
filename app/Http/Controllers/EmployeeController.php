<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class EmployeeController extends Controller
{
    /**
     * Display a tree-like listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tree()
    {
        $employees = Employee::where('id', 1)->get();

        return view('employee.tree', compact('employees'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Employee::query();
        $filters = [];

        if ($name = request('name')) {
            $query = $query->where('name', 'like', "%{$name}%");
            $filters['name'] = $name;
        }

        if ($position = request('position')) {
            $query = $query->where('position', 'like', "%{$position}%");
            $filters['position'] = $position;
        }

        if ($hired = request('hired')) {
            $query = $query->where('hired', $hired);
            $filters['hired'] = $hired;
        }

        if ($salary = request('salary')) {
            $query = $query->where('salary', $salary);
            $filters['salary'] = $salary;
        }

        if ($sort = request('sort')) {
            $query = $query->orderBy($sort, 'asc');
            $filters['sort'] = $sort;
        }

        $employees = $query->paginate(20);
        $employees->appends($filters)->links();

        if (request()->ajax()) {
            return response()->json(
                View::make(
                    'partials.employee-table',
                    ['employees' => $employees, 'filters' => $filters]
                )->render());
        }

        return view('employee.index', compact('employees', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
