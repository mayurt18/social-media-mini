<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FriendController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('q');
    $users = User::where('name', 'LIKE', "%{$query}%")->get();
    return view('friends.search', compact('users'));
}

public function addFriend($id)
{
    $user = User::findOrFail($id);
    auth()->user()->friendRequestsSent()->attach($user);

    return redirect()->back()->with('success', 'Friend request sent.');
}

public function acceptFriend($id)
{
    $user = User::findOrFail($id);
    auth()->user()->friends()->attach($user);

    return redirect()->back()->with('success', 'Friend request accepted.');
}


}
