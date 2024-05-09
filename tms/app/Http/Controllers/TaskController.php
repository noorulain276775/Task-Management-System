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
        return view('tasks.index', compact('tasks', 'pendingCount', 'doneCount', 'ongoingCount', 'id'));
    }

    public function store(Request $request)
    {
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

        
    
        // $pendingCount = Task::where('user_id', $request->user_id)
        //     ->where('task_status_id', 1)
        //     ->count();
        // $doneCount = Task::where('user_id', $request->user_id)
        //     ->where('task_status_id', 3)
        //     ->count();
        // $ongoingCount = Task::where('user_id',$request->user_id)
        //     ->where('task_status_id', 2)
        //     ->count();
    
        // $tasks = Task::where('user_id', $request->user_id)->get();
        return redirect()->back()->with('success', 'Task created successfully.');
        // return view('tasks.index', compact('tasks', 'pendingCount', 'doneCount', 'ongoingCount'));
    }
    

    // public function show(Request $request, $id)
    // {
    //     $task = Task::find($id);
    //     if ($task) {
    //         return view('tasks.index');
    //     } else {
    //         return redirect()
    //             ->route('tasks.index')
    //             ->withErrors(['Something went Wrong']);
    //     }
    // }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'task_id' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $id = $request->task_id;
        $task = Task::find($id);
        if (!$task) {
            abort(404, 'Task not found');
        }

        if ($task) {
            $task->title = $request->title;
            $task->description = $request->description;
            $task->save();
            $success = true;
        } else {
            $success = false;
        }
        if ($success) {
            return redirect()->back()->with('success', 'Task updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Task can not be edited.');
        }
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        $success = $task->delete();
        if ($success) {
            return redirect()->back()->with('success', 'Task deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Task can not be deleted.');
        }
    }
}
