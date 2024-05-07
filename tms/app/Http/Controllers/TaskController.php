<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

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
        // dd($tasks->first()->task_statuses->name);
        return view('tasks.index', compact('tasks', 'pendingCount', 'doneCount', 'ongoingCount'));
    }
}
