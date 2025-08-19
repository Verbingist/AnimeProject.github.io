<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Feedback;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


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

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Успешный вход'], 200);
        }
        return response()->json(['message' => 'Неверные данные'], 401);
    }
    public function addFeedback(Request $request)
    {
        if (!Auth::check())
            return response()->json(['message' => 'Вы не авторизованы', 'status' => 400], 400);

        $userid = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'AnimeName' => 'required',
            'status' => 'required',
            'anime_feedback' => '',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Название и статус обязательны'], 400);
        }

        $anime = Feedback::select('AnimeName')->where('AnimeName', '=', $request['AnimeName'])
            ->where('user_id', '=', $userid)->first();

        if ($anime)
            return response()->json(['message' => 'Отзыв на такое аниме уже существует'], 200);

        Feedback::insert([
            'user_id' => $userid,
            'AnimeName' => $request['AnimeName'],
            'status' => $request['status'],
            'anime_feedback' => $request['anime_feedback'],
        ]);

        return response()->json(['message' => 'Отзыв успешно записан', 'status' => 200], 200);
    }
    public function deleteFeedback(Request $request)
    {
        if (!Auth::check())
            return response()->json(['message' => 'Вы не авторизованы', 'status' => 400], 400);

        $userid = Auth::user()->id;
        $AnimeName = $request->query('AnimeName');

        $validator = Validator::make(['AnimeName' => $AnimeName], [
            'AnimeName' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Название обязательно'], 400);
        }

        $deletedCount = Feedback::where('AnimeName', '=', $AnimeName)
            ->where('user_id', '=', $userid)
            ->delete();

        if ($deletedCount > 0)
            return response()->json(['message' => 'Отзыв успешно записан', 'status' => 200], 200);
        else
            return response()->json(['message' => 'Отзыв не найден', 'status' => 200], 200);
    }
    public function updateFeedback(Request $request)
    {
        if (!Auth::check())
            return response()->json(['message' => 'Вы не авторизованы', 'status' => 400], 400);

        $userid = Auth::user()->id;

        $validator = Validator::make($request->all(), [
            'AnimeName' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Название обязательно'], 400);
        }

        if ($request['status'])
            $updatedCount = Feedback::where('AnimeName', '=', $request['AnimeName'])
                ->where('user_id', '=', $userid)->update([
                        'anime_feedback' => $request['anime_feedback'],
                        'status' => $request['status'],
                    ]);
        else
            $updatedCount = Feedback::where('AnimeName', '=', $request['AnimeName'])
                ->where('user_id', '=', $userid)->update([
                        'anime_feedback' => $request['anime_feedback'],
                    ]);

        if ($updatedCount > 0)
            return response()->json(['message' => 'Отзыв успешно записан', 'status' => 200], 200);
        else
            return response()->json(['message' => 'Отзыв не найден', 'status' => 200], 200);
    }
    public function getProjects()
    {
        $projects = Project::all();
        return response()->json(['projects' => $projects, 'status' => 200], 200);
    }
    public function isAuth(Request $request)
    {
        return response()->json(['isAuth' => Auth::check(), 'status' => 200], 200);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Успешный выход'], 200);
    }
    public function userSearch(Request $request)
    {
        $users = User::select('email')->where('email', 'like', $request['Users'] . '%')->simplePaginate(18);
        return response()->json(['data' => $users->items(), 'notLast' => $users->hasMorePages(), 'status' => 200], 200);
    }
    public function feedbackSearch(Request $request)
    {
        $email = $request['email'];
        if (!isset($request['email']) && Auth::check())
            $email = Auth::user()->email;
        $userid = User::where('email', '=', $email)->first()->id;
        $feedbacks = Feedback::where('user_id', '=', $userid)->
            where('status', '=', $request['status'])
            ->where('AnimeName', 'like', $request['AnimeName'] . '%')->orderBy('id')->paginate(9);

        return response()->json(['data' => $feedbacks->items(), 'notLast' => $feedbacks->hasMorePages(), 'status' => 200], 200);
    }
}
