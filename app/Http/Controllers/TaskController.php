<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\Promise\task;

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
            Log::error("Error getting task: " . $exception->getMessage());

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

            $validator = Validator::make($request->all(), [
                'title' => 'required|string',
                'user_id' => ['required', 'integer'],
            ]);

            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => $validator->errors()
                    ],
                    400
                );
            };

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
            Log::error("Error creating task: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error creating tasks"
                ],
                500
            );
        }
    }

    public function updateTask(Request $request, $id)
    {
        try {
            $task = Task::find($id);

            if (!$task) {
                return response()->json(
                    [
                        'success' => true,
                        'message' => "Task doesnt exists"
                    ],
                    404
                );
            }

            $title = $request->input('title');
            $status = $request->input('status');

            if (isset($title)) {
                $task->title = $title;
            }

            if (isset($status)) {
                $task->status = $status;
            }

            $task->save();

            return response()->json(
                [
                    'success' => true,
                    'message' => "Task " . $id . " updated"
                ],
                200
            );
        } catch (\Exception $exception) {
            Log::error("Error updating task: " . $exception->getMessage());

            return response()->json(
                [
                    'success' => false,
                    'message' => "Error updating task"
                ],
                500
            );
        }
    }
}
