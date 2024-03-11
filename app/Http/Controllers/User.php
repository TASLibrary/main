<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class User extends Controller
{
    /**
     * Updates a given User
     * @param Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, \App\Models\User $user)
    {
        if ($request->getMethod() == 'POST') {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
                'affiliation' => ['required', 'string', 'max:255'],
                'role' => ['required', 'integer']
            ]);

            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->affiliation = $validated['affiliation'];
            $user->role = $validated['role'];

            $user->save();

            return redirect()->to(route('user.list'))->with('status', "User $user->username was updated.");
        }
        else{
            return view('tas/user/update', ['user' => $user]);
        }
    }

    /**
     * Reads a given User
     * @param \App\Models\User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function read(\App\Models\User $user)
    {
        return view('tas/user/read', ['user' => $user]);
    }

    /**
     * Lists Users except the current user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        $users = \App\Models\User::whereNot('id', request()->user()->id)->paginate(10);
        return view('tas/user/list', ['users' => $users]);
    }

    /**
     * Bans a given User
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ban(\App\Models\User $user)
    {
        $user->ban()->save();
        return redirect()->to(route('user.list', [$user->id]))->with('status', "User '$user->username' was banned and won't be able to login.");
    }

    /**
     * Activates a given User
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activate(\App\Models\User $user)
    {
        $user->activate()->save();
        return redirect()->to(route('user.list', [$user->id]))->with('status', "User '$user->username' was activated and can login.");
    }
}
