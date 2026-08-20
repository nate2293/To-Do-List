<?php

namespace App\Http\Controllers;

use App\Models\Task;
use id;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

use function Laravel\Prompts\task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Retrieve only tasks belonging to the logged-in user
        $tasks = Task::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
            'concluded_at' => 'nullable|date',
            'deadline' => 'nullable|date',
        ]);

        $validatedData['completed'] = $request->boolean('completed');

        if ($validatedData['completed']) {
            $validatedData['concluded_at'] = now();
        } else {
            $validatedData['concluded_at'] = null;
        }
        $validatedData['user_id'] = $request->user()->id;

        // Create a new task using the validated data
        Task::create($validatedData);

        // Redirect to the tasks index page with a success message
        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        // Find the task by ID and pass it to the view
        $task = Task::findOrFail($id);

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        // Find the task by ID and pass it to the view
        $task = Task::findOrFail($id);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            // Validation rules for the task fields
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completed' => 'required|boolean',
            'concluded_at' => 'nullable|date',
            'deadline' => 'nullable|date',
        ]);

        // Find the task by ID and update it with the validated data
        $task = Task::findOrFail($id);
        $task->update($validatedData);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        // Find the task by ID and delete it
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}
