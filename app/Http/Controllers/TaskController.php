<?php

namespace App\Http\Controllers;

use App\Models\Task;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class TaskController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $api_data = Task::where("user_id", $id)->get();
        return response()->json($api_data);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $task = Task::create([
            'name' => $request->name,
            'status' => "0",
            'user_id' => Auth::id(),
        ]);
        return response()->json($task);
    }

    public function softdelete($id)
    {
        Task::find($id)->delete();

        return response()->json(['success' => "task deleted"]);
    }

    public function completeTask($id)
    {
        $task = Task::find($id);
        $task->status = "1";
        $task->save();
        return response()->json(['success' => "task completed"]);
    }

    public function pendingTask($id)
    {
        $task = Task::find($id);
        $task->status = "0";
        $task->save();
        return response()->json(['success' => "task make pending"]);
    }

    public function deletedTasksList()
    {
        $id = Auth::id();
        $api_data = Task::where("user_id", $id)->onlyTrashed()->get();
        return response()->json(['api_data' => $api_data]);
    }

    public function retriveDeletedTask($id)
    {
        $task = Task::withTrashed()->find($id)->restore();
        return response()->json(['success' => "task restored"]);
    }

    public function jsonFileDownload()
    {
        $id = request()->user()->id;
        $api_data = Task::withTrashed()->where("user_id", $id)->get();

        $data = json_encode($api_data);

        $jsongFile = time() . '_file.json';

        File::put(public_path('/upload/json/' . $jsongFile), $data);

        return Response::download(public_path('/upload/json/' . $jsongFile));
    }

    public function allTasks()
    {
        $id = Auth::id();
        $api_data = Task::where("user_id", $id)->get();
        return view('task.alltasks', compact("api_data"));
    }
}
