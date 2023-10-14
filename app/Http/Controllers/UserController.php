<?php

namespace App\Http\Controllers;

use App\Models\MedicalExam;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserController extends Controller
{
    public function show()
    {

        $user = auth()->user();
        $medicalData = MedicalExam::all();

        return response()->json(['user' => $user, 'medicalData' => $medicalData]);
    }

    public function edit()
    {

        $user = auth()->user();
       
       
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // Log::info($request->all());

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|integer',
            'qualification' => 'nullable|string|max:255',
            'qualification_year' => 'nullable|integer',
            'region' => 'nullable|string|max:255',
            'areas' => 'nullable|array',

        ]);

        $user->update($data);
        return response()->json(['message' => 'Profile updated successfully'], Response::HTTP_OK);
    }

    public function getUserData(Request $request)
    {
        // ログインユーザーの情報を取得
        $user = Auth::user();

        // ユーザーデータを返す
        return response()->json($user);
    }
}
