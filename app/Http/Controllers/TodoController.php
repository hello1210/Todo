<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{

    public int $user_id = 1;


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return [
            'message' => 'TodoController working',
            'status' => 'success',
            'data' => Todo::all()
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->user_id = $request->input('user_id');
        $todo->save();

        return response()->json([
            'message' => 'Todo created successfully',
            'todo' => $todo
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json([
                'message' => 'Todo not found',
                'status' => 'error'
            ], 404);
        }

        return [
            'message' => 'TodoController working',
            'status' => 'success',
            'data' => $todo
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $todo = Todo::find($id);
        $todo->title = $request->input('title');
        $todo->description = $request->input('description');
        $todo->completed = $request->input('completed');
        $todo->save();

        return response()->json([
            'message' => 'Todo updated successfully',
            'todo' => $todo
        ], 200);
    }

    public function getByUser(Request $request, string $id): array | JsonResponse
    {
        $completed = $request->query('completed', null);
        $title = $request->query('title', null);
        $description = $request->query('description', null);

        $className = Todo::class;

        echo $className;

        $query = $className::where('user_id', $id);

        if ($completed !== null) {
            $query->where('completed', $completed);
        }

        if ($title) {
            $query->where('title', 'like', '%' . $title . '%');
        }

        if ($description) {
            $query->where('description', 'like', '%' . $description . '%');
        }

        $todo = $query->get();

        if (!$todo) {
            return response()->json([
                'message' => 'Todo not found',
                'status' => 'error'
            ], 404);
        }


        return [
            'message' => 'TodoController working',
            'status' => 'success',
            'data' => $todo
        ];
    }

    public function markAsCompleted(string $id)
    {
        $todo = Todo::find($id);
        $todo->completed = true;
        $todo->save();

        return response()->json([
            'message' => 'Todo marked as completed',
            'todo' => $todo
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return response()->json([
            'message' => 'Todo deleted successfully',
            'todo' => $todo
        ], 201);
    }
}
