<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getNames()
    {
        $data = User::all(['name', 'password']);
        return response()->json($data, 200);
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Введены некорректные данные'], 400);
        }

        User::insert([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json(['message' => 'Успех'], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Введены некорректные данные'], 400);
        }

        $user = User::where('email', '=', $request['email'])->first();

        if ($user && Hash::check($request['password'], $user->password)) {
            $request->session()->put('user_id', $user->id);
            return response()->json(['message' => 'success'], 200);
        } else
            return response()->json(['message' => 'error'], 400);
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
