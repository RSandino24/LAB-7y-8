<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        $tasks = Task::where('user_id', $user->id)->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('tasks.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'priority' => 'required|in:baja,media,alta',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($validator->fails()) {
            return redirect()->route('tasks.create')
                ->withErrors($validator)
                ->withInput();
        }

        $task = new Task();
        $task->title = $request->input('title');
        $task->priority = $request->input('priority');
        $task->completed = false;
        $task->user_id = auth()->user()->id;
        $task->save();

        $task->tags()->sync($request->input('tags', []));

        return redirect()->route('tasks.index')->with('success', 'Tarea creada correctamente');
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $tags = Tag::all();
        $user = auth()->user();
        return view('tasks.edit', compact('task', 'tags', 'user'));
    }
    



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'priority' => 'required|in:baja,media,alta',
            'completed' => 'required|boolean',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('tasks.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
    
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->priority = $request->input('priority');
        $task->completed = $request->input('completed');
        $task->save();
    
        $task->tags()->sync($request->input('tags', []));
    
        $user = auth()->user();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
    
        return redirect()->route('tasks.index')->with('success', 'Tarea actualizada correctamente');
    }
    

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada correctamente.');
    }

    public function complete(Task $task)
    {
        $task->update(['completed' => true]);
        return redirect()->route('tasks.index')->with('success', 'Tarea marcada como completada.');
    }
}
