<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);
        $data = [
            'employee' => $employees,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function show(string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            $data = [
                'message' => 'Employee not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'employee' => $employee,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $employee = Employee::create($request->all());
        if (!$employee) {
            $data = [
                'message' => 'Employee not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'employee' => $employee,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function update(Request $request, string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            $data = [
                'message' => 'Employee not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $employee->update($request->all());
        $data = [
            'employee' => $employee,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            $data = [
                'message' => 'Employee not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $employee->delete();
        return response()->json(null, 204);
    }

}
