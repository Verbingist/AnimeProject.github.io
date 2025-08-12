<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Feedback;

class UserController extends Controller
{
    // public function getPageOfFeedbacks()
    // {
    //     $data = User::all(['name', 'password']);
    //     return response()->json($data, 200);
    // }
    public function register(Request $request)
    {
        if (!$request['name']) {
            return response()->json(['message' => 'invalid name'], 400);
        }
        if (!$request['email']) {
            return response()->json(['message' => 'invalid email'], 400);

        }
        if (!$request['phone']) {
            return response()->json(['message' => 'invalid phone'], 400);

        }
        if (!$request['password']) {
            return response()->json(['message' => 'invalid password'], 400);
        }
        User::insert([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => $request['password'],
        ]);

        return response(null, 200);
    }

    public function login(Request $request)
    {
        $user = User::where('name', '=', $request['name'])
            ->where('password', '=', $request['password'])
            ->first();

        if ($user)
            return response('success', 200);
        else
            return response('error', 400);
    }
    public function getPageOfFeedbacks($userId, $pageNumber)
    {
        User::where('id', '=', $userId)->feedback()
            ->offset($pageNumber * 9)->limit(9);
    }
    public function addFeedback(Request $request)
    {
        Feedback::insert([
            'user_id' => $request['userid'],
            'AnimeName' => $request['AnimeName'],
            'anime_feedback' => $request['anime_feedback']
        ]);
    }
    public function deleteFeedback(Request $request)
    {

    }
    public function updateFeedback()
    {

    }
}
