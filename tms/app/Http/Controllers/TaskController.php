<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index(Request $request, $id)
    {
        $pendingCount = Task::where('user_id', $id)
            ->whereHas('task_statuses', function ($query) {
                $query->where('name', 'pending');
            })
            ->count();

        $doneCount = Task::where('user_id', $id)
            ->whereHas('task_statuses', function ($query) {
                $query->where('name', 'done');
            })
            ->count();

        $ongoingCount = Task::where('user_id', $id)
            ->whereHas('task_statuses', function ($query) {
                $query->where('name', 'on-going');
            })
            ->count();
        $tasks = Task::where('user_id', $id)->get();
        return view('tasks.index', compact('tasks', 'pendingCount', 'doneCount', 'ongoingCount'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'user_id' => 'required',
            'task_status_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
    
        $task = Task::create([
            'user_id' => $request->user_id,
            'task_status_id' => $request->task_status_id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        
    
        $pendingCount = Task::where('user_id', $request->user_id)
            ->where('task_status_id', 1)
            ->count();
        $doneCount = Task::where('user_id', $request->user_id)
            ->where('task_status_id', 3)
            ->count();
        $ongoingCount = Task::where('user_id',$request->user_id)
            ->where('task_status_id', 2)
            ->count();
    
        $tasks = Task::where('user_id', $request->user_id)->get();
        return redirect()->back()->with('success', 'Task created successfully.');
        // return view('tasks.index', compact('tasks', 'pendingCount', 'doneCount', 'ongoingCount'));
    }
    

    public function show(Request $request, $id)
    {
        $level = Level::find($id);
        if ($level) {
            return view('levels.index');
        } else {
            return redirect()
                ->route('levels.index')
                ->withErrors(['Something went Wrong']);
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string',
            'passing_questions' => 'required|integer',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $path = $file->store('levels', ['disk' => 'public']);
            $imagePath = url('/') . '/uploads/' . $path;
        }

        $level = Level::find($id);
        if (!$level) {
            abort(404, 'Level not found');
        }

        if ($level) {
            $level->name = $request->name;
            $level->description = $request->description ?? '';
            if ($imagePath != null) {
                $level->image = $imagePath;
            }
            $level->is_active = $request->is_active ?? 0;
            $level->actor = $request->actor ?? 'Robo';
            $level->passing_questions = $request->passing_questions;
            $level->save();
            $success = true;
        } else {
            $success = false;
        }
        if ($success) {
            return redirect()->route('levels.index')->with('success', 'Level updated successfully');
        } else {
            return redirect()
                ->route('levels.index')
                ->withErrors(['Something went Wrong']);
        }
    }

    public function destroy(Request $request, $id)
    {
        $level = Level::find($id);
        $success = $level->delete();
        if ($success) {
            return redirect()->route('levels.index')->with('success', 'Level deleted successfully');
        } else {
            return redirect()
                ->route('levels.index')
                ->withErrors(['Something went Wrong while deleting levels']);
        }
    }
}
