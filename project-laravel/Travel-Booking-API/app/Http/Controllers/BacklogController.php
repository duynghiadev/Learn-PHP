<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use Illuminate\Http\Request;

class BacklogController extends Controller
{
    public function index()
    {
        $backlogs = Backlog::paginate(10);
        $data = [
            'backlogs' => $backlogs,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function show(string $id)
    {
        $backlog = Backlog::find($id);
        if (!$backlog) {
            $data = [
                'message' => 'Backlog not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'backlog' => $backlog,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $backlog = Backlog::create($request->all());
        if (!$backlog) {
            $data = [
                'message' => 'Destination not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $data = [
            'backlog' => $backlog,
            'status' => 201
        ];
        return response()->json($data, 201);
    }

    public function update(Request $request, string $id)
    {
        $backlog = Backlog::find($id);
        if (!$backlog) {
            $data = [
                'message' => 'Backlog not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $backlog->update($request->all());
        $data = [
            'backlog' => $backlog,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function destroy(string $id)
    {
        $backlog = Backlog::find($id);
        if (!$backlog) {
            $data = [
                'message' => 'Backlog not found',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        $backlog->delete();
        return response()->json(null, 204);
    }

}
