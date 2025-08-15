<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|alpha',
            'email' => 'required|email|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Введены некорректные данные', 'status' => 400], 400);
        }

        User::insert([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json(['message' => 'Успешная регистрация', 'status' => 200], 200);
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
            return response()->json(['message' => 'Успешный вход', 'status' => 200], 200);
        } else
            return response()->json(['message' => 'Неверный логин или пароль', 'status' => 400], 400);
    }
    public function getPageOfFeedbacks($login)
    {
        $userid = User::where('email', '=', $login)->first()->id;
        $feedbacks = Feedback::where('user_id', '=', $userid)->simplePaginate(9);
        return response()->json(['data' => $feedbacks->items(), 'status' => 200], 200);
    }
    public function getLogins()
    {
        $emails = User::select('email')->simplePaginate(10);
        return response()->json(['data' => $emails->items(), 'status' => 200], 200);
    }
    public function addFeedback(Request $request)
    {
        $userid = $request->session()->get('user_id');
        if (!$userid)
            return response()->json(['message' => 'Вы не авторизованы', 'status' => 400], 400);

        $validator = Validator::make($request->all(), [
            'AnimeName' => 'required',
            'anime_feedback' => '',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Название обязательно'], 400);
        }

        Feedback::insert([
            'user_id' => $userid,
            'AnimeName' => $request['AnimeName'],
            'anime_feedback' => $request['anime_feedback'],
        ]);

        return response()->json(['message' => 'Отзыв успешно записан', 'status' => 200], 200);
    }
    public function deleteFeedback(Request $request)
    {
        $userid = $request->session()->get('user_id');
        if (!$userid)
            return response()->json(['message' => 'Вы не авторизованы', 'status' => 400], 400);

        $validator = Validator::make($request->all(), [
            'AnimeName' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Название обязательно'], 400);
        }

        $deletedCount = Feedback::where('AnimeName', '=', $request['AnimeName'])
            ->where('user_id', '=', $userid)
            ->delete();

        if ($deletedCount > 0)
            return response()->json(['message' => 'Отзыв успешно записан', 'status' => 200], 200);
        else
            return response()->json(['message' => 'Отзыв не найден', 'status' => 200], 200);
    }
    public function updateFeedback(Request $request)
    {
        $userid = $request->session()->get('user_id');
        if (!$userid)
            return response()->json(['message' => 'Вы не авторизованы', 'status' => 400], 400);

        $validator = Validator::make($request->all(), [
            'AnimeName' => 'required',
            'anime_feedback' => '',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Название обязательно'], 400);
        }

        $updatedCount = Feedback::where('AnimeName', '=', $request['AnimeName'])
            ->where('user_id', '=', $userid)->update([
                    'anime_feedback' => $request['anime_feedback'],
                ]);

        if ($updatedCount > 0)
            return response()->json(['message' => 'Отзыв успешно записан', 'status' => 200], 200);
        else
            return response()->json(['message' => 'Отзыв не найден', 'status' => 200], 200);
    }
}
