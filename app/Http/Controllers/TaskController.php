<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', auth()->id());

        if ($request->has('search')) {
            $tasks = $tasks->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('status')) {
            $tasks = $tasks->where('status', $request->status);
        }

        $tasks = $tasks->get();

        return view('tasks.index', compact('tasks'));
    }


    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('tasks.create'); // Ensure you have a Blade view file at resources/views/tasks/create.blade.php
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending',
            'user_id' => auth()->id(),
        ]);

        // Redirect to the task list with a success message
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        
    }

    public function updateStatus(Task $task, Request $request)
    {
        $task->status = $request->status;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

}
