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

            return response()->json(['message' =>'Notification created successfully!', 'data' => $notification], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create notification'], 500);
        }
    }

    public function index()
    {
        $user = auth()->user();  // 認証済みのユーザーを取得

        // to_user_id または from_user_id がログインユーザーの id と一致する通知を取得
        $notifications = Notification::where('to_user_id', $user->id)
            ->orWhere('from_user_id', $user->id)
            ->with(['fromUser', 'toUser'])  // from_user リレーションを事前に読み込む
            ->get();

        return response()->json($notifications);
    }



    public function show($id)
    {
        $notification = Notification::with(['toUser', 'fromUser'])->find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found.'], 404);
        }

        return response()->json($notification);
    }



    public function update(Request $request, Notification $notification)
    {
        // 通知のステータスを更新
        $notification->update([
            'status' => $request->input('status'),
            'accept_message' => $request->input('accept_message')
        ]);

        // 必要な場合、通知を送信する処理をここに追加

        return response()->json(['message' => 'Notification status updated successfully']);
    }
}
