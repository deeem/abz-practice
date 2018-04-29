<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Image;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->only('name', 'position', 'hired', 'salary');
        $employee = Employee::create($data);

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $request->file('photo')->storeAs('photos', $filename);

            // making thumb
            if (!file_exists(storage_path('app/thumbs'))) {
                mkdir(storage_path('app/thumbs', 666, true));
            }

            Image::make($photo)->resize(100, 100)->save(storage_path('app/thumbs/'.$filename));

            // save employee photo
            $employee->photo = $filename;
            $employee->save();
        }

        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Request\UpdateEmployeeRequest  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $superviser = Employee::find(request('superviser'));
        $data = $request->only('name', 'position', 'hired', 'salary');

        $employee->fill($data);
        $employee->superviser()->associate($superviser);
        $employee->save();

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Employee::destroy($employee->id);

        return redirect()->route('employee.index');
    }

    /**
     * Ajax response that contains employees
     */
    public function superviser()
    {
        $term = request('search');
        $employees = Employee::where('name', 'like', "%{$term}%")->paginate(10);

        $formattedEmployees = [];
        foreach ($employees as $employee) {
          $formattedEmployees[] = ['id' => $employee->id, 'text' => $employee->name];
        }

        return response()->json($formattedEmployees);
    }

}
