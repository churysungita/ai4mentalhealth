<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Other methods...

    public function logout()
    {
        // Perform logout logic here (e.g., invalidate session, clear authentication, etc.)
        // For example, in a typical scenario, you might use something like:
         auth()->logout();

        // Redirect to the desired page after logout
    
          // Redirect to the login page after logout
    return redirect()->route('admin.login');
    }
}
