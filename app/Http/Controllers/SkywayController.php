<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkywayController extends Controller
{

    public function getSkywayData($notificationId)
    {
        $notification = Notification::with(['fromUser', 'medicalExam'])
            ->find($notificationId);

        if (!$notification) {
            return response()->json(['error' => 'Notification not found'], 404);
        }

        // 権限の確認
        $this->authorize('view', $notification);

        $skywayApiKey = env('SKYWAY_API_KEY');
        $loggedInUser = Auth::user(); // 現在のログインユーザーの取得

        return response()->json([
            'mySkywayId' => $loggedInUser->skyway_id, // ログインユーザーのSkywayID
            'toUserSkywayId' => $notification->toUser->skyway_id, // toUserのSkywayID
            'fromUserName' => $notification->fromUser->name,
            'toUserName' => $notification->toUser->name,
            'medicalExam' => $notification->medicalExam,
            'skywayApiKey' => $skywayApiKey
        ]);
    }

}
