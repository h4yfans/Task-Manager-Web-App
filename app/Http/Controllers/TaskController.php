<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function getIndex()
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', ['tasks' => $tasks]);    }

    public function postNewTask(Request $request)
    {
        $this->validate($request, [
            'task_name' => 'required'
        ]);

        $task = new Task();
        $task->task_name = $request['task_name'];

        $message = 'There was a error!';
        if ($request->user()->tasks()->save($task)) {
            $message = 'Task created!';
        }

        return redirect()->route('add.task')->with(['message' => $message]);
    }

    public function postEditTask(Request $request)
    {
        $this->validate($request, [
            'task_name' => 'required'
        ]);

        $task = Task::find($request['taskId']);
        if (Auth::user() != $task->user) {
            return redirect()->route('dashboard');
        }

        $task->task_name = $request['task_name'];
        $task->update();

        return response()->json(['new_body' => $task->task_name], 200);
    }

    public function getTaskDelete($task_id){
        $task = Task::find($task_id);

        if (Auth::user() != $task->user){
            return redirect()->back();
        }

        $task->delete();
        return redirect()->route('dashboard')->with(['success' => 'Successfully deleted!']);
    }
}
