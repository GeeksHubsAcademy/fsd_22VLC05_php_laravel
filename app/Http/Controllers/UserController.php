<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getAllUsers()
    {
        try {
            // Ejemplo con query builder
            // $users = DB::table('users')
            //     ->select('id', 'name', 'email')
            //     ->get()
            //     ->toArray();

            $users = User::query()->get()->toArray();
    
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

    public function getUserById($id)
    {
        try {
            $user = User::find($id);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Users retrieved successfully',
                    'data' => $user
                ],
                200
            ); 

        } catch (\Exception $exception) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error retrieving user: '.$exception->getMessage()
                ],
                500
            );
        }

        return $id;
    }

    public function updateUser($id)
    {
        return $id;
    }

    public function deleteUser($id)
    {
        return $id;
    }
}
