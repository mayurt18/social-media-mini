<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.index', compact('user'));
    }
    public function search(Request $request)
    {
        $query = $request->input('q');
    
        $users = User::where('name', 'LIKE', "%{$query}%")->get();
    
        return view('friends.search', compact('users'));
    }
    
}
