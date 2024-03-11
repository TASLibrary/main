<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RegisterModal extends Component
{
    public bool $showingModal;

    public string $name;

    public string $email;

    public string $password;

    public string $password_confirmation;

    public string $affiliation;

    public string $username;

    public bool $registration_completed;

    public $listeners = [
        'hideMe' => 'hideModal',
        'initRegisterModal' => 'showModal'
    ];

    public function mount()
    {
        $this->initiate();
    }

    public function showModal()
    {
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->initiate();
        $this->showingModal = false;
    }

    public function register()
    {
        $createNewUserAction = new CreateNewUser();
        $user = $createNewUserAction->create([
            'username' => $this->username,
            'email' => $this->email,
            'name' => $this->name,
            'affiliation' => $this->affiliation,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'terms' => 'accepted'
        ]);

        $user->sendEmailVerificationNotification();

        $this->registration_completed = true;
    }

    public function switchToLogin()
    {
        $this->initiate();
        $this->emit('initLoginModal');
    }

    public function render()
    {
        return view('livewire.register-modal');
    }

    private function initiate()
    {
        $this->showingModal = false;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->affiliation = '';
        $this->username = '';
    }
}
