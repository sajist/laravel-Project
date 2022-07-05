<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function showTodos(){
      $result =   Todo::all()->toArray();
      dd($result);
    }
    public function showSingleTodo($id){
        $result = Todo::find($id)->toArray();
        dd($result);
      
    }
    public function create()
    {
       return view('Todo\TodoForm');
    }
    public function store(TodoRequest $request)
    {
        $valid_data = $request->validated();
          $result = Todo::create([
                    'title' => $valid_data['title'],
                    'slug' => $valid_data['slug'],
                    'description' => $valid_data['description']
                     ]);
          if ($result)
          {
             request()->session()->flash('message','Todo created successfully');
             return redirect()->route('todos.index');
          }
    }
    public function show(Todo $todo)
    {
       return view('Todo/showTodo',['todos' => $todo]);
    }

    public function edit(Todo $todo)
    {
       return view('todo/editTodo',['todo' => $todo]);
    }
    public function update(TodoRequest $request, Todo $todo)
    {
        $valid_data = $request->validated();
         $result = $todo->update([
           'title' => $valid_data['title'],
           'slug' => $valid_data['slug'],
           'description' => $valid_data['description'],
            ]);
       if ($result)
         {
            request()->session()->flash('message','Update successfully');
             return redirect()->route('todos.index');
         }
    }
    public function destroy(Todo $todo)
    {
       $result = $todo->delete();
      if ($result)
       {
           request()->session()->flash('message','Delete successfully');
          return redirect()->back();
     }
        return false;
    }
}
