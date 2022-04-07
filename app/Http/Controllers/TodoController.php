<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Dotenv\Exception\ValidationException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class TodoController extends Controller
{
    
    public function index(){
      
        $todo = Todo::all();
        return view('todo.index')->with('todos', $todo);
    
    }
    public function create(){
        return view('todo.create');
    }
    public function details(Todo $todo){

        return view('todo.details')->with('todos', $todo);
    
    }
    public function edit(Todo $todo){
    
        return view('todo.edit')->with('todos', $todo);
    
    }
    public function update(Todo $todo){

        try {
            $this->validate(request(), [
                'name' => ['required'],
                'description' => ['required'],
           
            ]);
        } catch (ValidationException $e) {
        }

        $data = request()->all();

       
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->save();

        session()->flash('success', 'Todo updated successfully');

        return redirect('/');

    }
    public function delete(Todo $todo){

        $todo->delete();

        return redirect('/');

    }
    public function store(){

        try {
            $this->validate(request(), [
                'name' => ['required'],
                'description' => ['required']
            ]);
        } catch (ValidationException $e) {
        }


        $data = request()->all();


        $todo = new Todo();
        //On the left is the field name in DB and on the right is field name in Form/view
        $todo->name = $data['name'];
        $todo->description = $data['description'];
        $todo->user_id = Auth::user()->id?:0;
        $todo->save();

        session()->flash('success', 'Todo created succesfully');

        return redirect('/');

    }
    public function setCurrentTimeZone(){  
        $input = request()->all();
        if(!empty($input)){
            $current_time_zone = $input['curent_zone'];
            request()->session()->put('current_time_zone',  $current_time_zone);
          
        }
    }
}
