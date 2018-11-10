<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class TodoController extends Controller
{
    public function index(): ResourceCollection
    {
        return TodoResource::collection(Todo::all());
    }

    public function store(TodoRequest $request): TodoResource
    {
        $todo = new Todo;
        $todo->title = $request->get('title');
        $todo->save();

        return new TodoResource($todo);
    }

    public function show(Todo $todo): TodoResource
    {
        return new TodoResource($todo);
    }

    public function update(TodoRequest $request, Todo $todo): TodoResource
    {
        $todo->title = $request->get('title');
        $todo->save();

        return new TodoResource($todo);
    }

    public function destroy(Todo $todo): JsonResponse
    {
        try {
            $todo->delete();
        } catch (Exception $e) {
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }

        return Response::json(null, HttpResponse::HTTP_NO_CONTENT);
    }
}
