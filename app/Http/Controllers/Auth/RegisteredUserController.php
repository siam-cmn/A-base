<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Authority;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegistrationRequest;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreRegistrationRequest $request): RedirectResponse|\Illuminate\Routing\Redirector
    {
        $user = DB::transaction(function () use ($request) {
            $organization = Organization::create([
                'name' => $request->organization_name,
                'slug' => Str::slug($request->organization_name).'-'.Str::random(5),
            ]);

            return User::create([
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'last_name_kana' => $request->last_name_kana,
                'first_name_kana' => $request->first_name_kana,
                'email' => $request->email,
                'password' => \Hash::make($request->password),
                'authority' => Authority::OWNER,
                'organization_id' => $organization->id,
            ]);
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
