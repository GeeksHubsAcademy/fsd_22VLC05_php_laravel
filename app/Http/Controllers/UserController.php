<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getAllUsers()
    {
        try {
            $users = DB::table('users')
                ->select('title')
                ->get()
                ->toArray();
    
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Users retrieved successfully',
                    'data' => $users
                ],
                200
            );
        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error retrieving: '.$exception->getMessage()
                ],
                500
            );
        }
    }

    public function createUser()
    {
        return ['post'];
    }
}
