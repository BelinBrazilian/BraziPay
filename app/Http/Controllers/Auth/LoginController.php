<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\TenancyUser;
use App\Models\Tenant;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = TenancyUser::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $tenant = Tenant::find($user->tenant_id);

            // Set the tenant's domain or subdomain
            $tenantDomain = $tenant->domains->first()->domain;

            // Redirect to the tenant's domain
            return redirect()->route('tenant.login', ['domain' => $tenantDomain]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}