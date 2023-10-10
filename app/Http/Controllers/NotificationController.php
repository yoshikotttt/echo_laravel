<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'to_user_id' => 'required|integer',
            'message' => 'required|string'
        ]);

        try {
            $notification = new Notification;
            $notification->from_user_id = Auth::id(); // ログインユーザーのIDを取得
            $notification->to_user_id = $request->to_user_id;
            $notification->message = $request->message;
            $notification->status = 0; // 例：0 = 未読, 1 = 既読 など、適切な初期値を設定
            $notification->save();

            return response()->json(['message' => 'Notification created successfully!'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create notification'], 500);
        }
    }

    public function index()
    {
        $user = auth()->user();  // 認証済みのユーザーを取得
        $notifications = Notification::where('to_user_id', $user->id)->get();
        return response()->json($notifications);
    }
}
