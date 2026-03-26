<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\officialmember;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $data = session('AuthUser') ?? session('user');
        if (!$data) {
            return redirect()->route('Member.Login')->with('error', 'Please login first.');
        }

        $AutoComplete = officialmember::where('member_id', $data)->first();
        if (!$AutoComplete) {
            return redirect()->route('Member.Login')->with('error', 'Member not found.');
        }

        $notifications = Notification::where('member_id', $data)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Members.Notifications', compact('AutoComplete', 'notifications'));
    }

    public function markAsRead(Request $request, $id)
    {
        $data = session('AuthUser') ?? session('user');
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        $notification = Notification::where('id', $id)->where('member_id', $data)->first();
        if ($notification) {
            $notification->is_read = true;
            $notification->save();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Notification not found'], 404);
    }
    
    public function countUnread(Request $request)
    {
        $data = session('AuthUser') ?? session('user');
        if (!$data) {
            return response()->json(['count' => 0]);
        }
        
        $count = Notification::where('member_id', $data)->where('is_read', false)->count();
        return response()->json(['count' => $count]);
    }
}
