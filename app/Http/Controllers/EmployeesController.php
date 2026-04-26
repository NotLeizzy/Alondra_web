<?php

namespace App\Http\Controllers;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        return Employees::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'email' => 'required|email|unique:employees,email'
        ]);

        return Employees::create($validated);
    }

    public function show(Employees $employee)
    {
        return $employee;
    }

    public function update(Request $request, Employees $employee)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|required',
            'middle_name' => 'nullable',
            'last_name' => 'sometimes|required',
            'email' => 'sometimes|email|unique:employees,email,' . $employee->id
        ]);

        $employee->update($validated);
        return $employee;
    }

    public function destroy(Employees $employee)
    {
        $employee->delete();
        return response()->json(['message' => 'Deleted']);
    }
}