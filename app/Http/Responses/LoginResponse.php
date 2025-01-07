<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $role = auth()->user()->Role;

        // Redirect sesuai role
        if ($role === 'Admin') {
            return redirect()->route('AdminPage.index');
        } elseif ($role === 'User') {
            return redirect()->route('dashboard');
        }

        // Redirect default jika role tidak dikenali
        return redirect('/');
    }
}
