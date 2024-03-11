<?php

namespace App\Http\Livewire;

use App\Enum\MessageStatus;
use App\Mail\MessageReceived;
use App\Models\Message;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class ContactUsModal extends Component
{
    public bool $showingModal;

    public bool $sent;

    public string $name;

    public string $email;

    public string $message;

    public $listeners = [
        'hideMe' => 'hideModal',
    ];

    public function mount()
    {
        $this->sent = false;
        $this->name = '';
        $this->email = '';
        $this->message = '';
    }
    public function showModal()
    {
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->initiate();
        $this->resetErrorBag();
    }

    public function send()
    {
        $this->resetErrorBag();

        $input = [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
            'status' => MessageStatus::Pending->value
        ];

        $validated = Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255'],
            'message' => ['required', 'string'],
            'status' => ['integer']
        ])->validate();

        $message = Message::create($validated);

        Mail::to(Setting::mail_from_address())->queue(new MessageReceived($message));

        $this->sent = true;
        session()->flash('status', 'Thank you for getting in touch. You message has been sent.');
    }

    public function render()
    {
        return view('livewire.contact-us-modal');
    }

    private function initiate()
    {
        $this->showingModal = false;
        $this->mount();
    }
}
