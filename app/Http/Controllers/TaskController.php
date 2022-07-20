<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function getAllTasks()
    {
        try {
            Log::info("Getting all Tasks");
            $tasks = Task::all()->toArray();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Get all Tasks",
                    'data' => $tasks
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error("Error getting task: ".$exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error getting tasks"
                ],
                500
            );
        }
    }

    public function createTask(Request $request)
    {
        try {
            Log::info("Creating a task");

            $title = $request->input('title');
            $userId = $request->input('user_id');

            $task = new Task();
            $task->title = $title;
            $task->user_id = $userId;

            $task->save();           


            return response()->json(
                [
                    'success' => true,
                    'message' => "Task created"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error("Error creating task: ".$exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating tasks"
                ],
                500
            );
        }
    }
}
