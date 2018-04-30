<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Image;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Psr7\Stream;
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
        $employee = Employee::create(
            $request->only('name', 'position', 'hired', 'salary')
        );

        if ($request->superviser) {
            $superviser = Employee::find(request('superviser'));
            $employee->superviser()->associate($superviser);
        }

        if ($request->hasFile('photo')) {
            $employee->photo = $this->storePhoto($request, $employee);
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
        $employee->fill($request->only('name', 'position', 'hired', 'salary'));

        if ($request->superviser) {
            $superviser = Employee::find(request('superviser'));
            $employee->superviser()->associate($superviser);
        }

        if ($request->hasFile('photo')) {
            $employee->photo = $this->storePhoto($request, $employee);
        }

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

    /**
     * Store photo from request and make thumb
     *
     * @return string stored filename
     */
    protected function storePhoto(Request $request, Employee $employee): string
    {
        $photo = $request->file('photo');
        $path =  Storage::disk('local')->putFile('/public/photos/', $photo);
        $path_parts = pathinfo($path);

        $thumb = Image::make($photo)->resize(100, null, function($constraint) {
            $constraint->aspectRatio();
        })->stream($path_parts['extension']);
        Storage::disk('local')->put('/public/thumbs/'.$path_parts['basename'], $thumb);

        return $path_parts['basename'];
    }
}
