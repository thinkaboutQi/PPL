<?php
// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user(); // ambil data user yang sedang login
        return view('profile', compact('user'));
    }
}
