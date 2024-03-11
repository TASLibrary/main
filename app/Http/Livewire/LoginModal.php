<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use Laravel\Sanctum\Sanctum;
use Livewire\Component;

class LoginModal extends Component
{
    public bool $showingModal;

    public string $username;

    public string $password;
    public bool $verified = true;

    public $listeners = [
        'hideMe' => 'hideModal',
        'showLoginModal' => 'showModal',
        'initLoginModal' => 'showModal'
    ];

    public function showModal()
    {
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->initiate();
    }

    public function login()
    {
        $username = $this->username;
        $password = $this->password;

        $user = User::where('username', $username)->first();

        if ($user &&
            Hash::check($password, $user->password)
        ) {
            if ($user->active){
                // User authenticated and logged in if not banned
                Auth::login($user);

                if (!$user->hasVerifiedEmail()) {
                    // Email not verified
                    return redirect()->to('email/verify');
                } else {
                    return redirect()->route('home');
                }

                $this->hideModal();
            }
            else{
                session()->flash('status', 'Login failed! Your account is banned.');
            }
        } else {
            //Show error message
            session()->flash('status', 'Login failed! Incorrect username or password.');
        }
    }

    public function switchToRegister()
    {
        $this->initiate();
        $this->emit('initRegisterModal');
    }

    public function render()
    {
        return view('livewire.login-modal');
    }

    private function initiate()
    {
        $this->username = '';
        $this->password = '';
        $this->showingModal = false;
        $this->verified = true;
    }
}
