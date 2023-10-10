<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('query');

        // `areas` カラムからクエリにマッチするデータを検索
        $users = User::whereJsonContains('areas', $query)->get();

        // $users = User::where('areas', 'LIKE', "%\"{$query}\"%")->get();


        if ($users->isEmpty()) {
            return response()->json(['message' => '一致するユーザが見つかりませんでした。']);
        }

        return response()->json($users);
    }
}
