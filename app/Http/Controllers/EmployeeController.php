<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

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
        $paginationLinks = [];

        if ($name = request('name')) {
            $query = $query->where('name', 'like', "%{$name}%");
            $paginationLinks['name'] = $name;
        }

        if ($position = request('position')) {
            $query = $query->where('position', 'like', "%{$position}%");
            $paginationLinks['position'] = $position;
        }

        if ($hired = request('hired')) {
            $query = $query->where('hired', $hired);
            $paginationLinks['hired'] = $hired;
        }

        if ($salary = request('salary')) {
            $query = $query->where('salary', $salary);
            $paginationLinks['salary'] = $salary;
        }

        if ($sort = request('sort')) {
            $query = $query->orderBy($sort, 'asc');
            $paginationLinks['sort'] = $sort;
        }

        $employees = $query->paginate(25);
        $employees->appends($paginationLinks)->links();

        return view('employee.index', compact('employees'));
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
