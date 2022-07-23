<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);

                return redirect('/admin/tanah')->with('success', 'Welcome '.$user->name);
            } else {
                return throw ValidationException::withMessages([
                    'password' => 'Password salah',
                ]);
            }
        }

        return throw ValidationException::withMessages([
            'email' => 'Email tidak ditemukan',
        ]);
    }
}
