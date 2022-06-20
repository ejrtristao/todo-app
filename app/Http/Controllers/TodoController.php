<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTodoRequest;
use App\Mail\TodoMailUser;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Type\Integer;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Todo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request)
    {
        $todo = Todo::create($request->all());
        Mail::to(Auth::user()->email)->send(new TodoMailUser($todo));
        return response()->json($todo, 201);
    }


    public function show(Todo $todo)
    {
        return response()->json($todo, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTodoRequest $request, Todo $todo)
    {

        $todo->update($request->all());
        return response()->json($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(null, 204);
    }

    public function completed(Todo $todo)
    {
        $todo = Todo::find($todo->id);
        $todo->status = "completed";
        $todo->save();
        return response()->json($todo, 200);
    }
}
