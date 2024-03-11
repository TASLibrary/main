<?php

namespace App\Http\Livewire;

use App\Enum\IssueStatus;
use App\Mail\IssueReceived;
use App\Models\Issue;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class IssueModal extends Component
{
    public bool $showingModal;

    public bool $sent;
    public int $usecase_id;

    public string $email;

    public string $message;

    public string $usecase_title;

    public $listeners = [
        'hideMe' => 'hideModal',
    ];

    public function mount()
    {
        $this->sent = false;
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
            'usecase_id' => $this->usecase_id,
            'email' => $this->email,
            'message' => $this->message,
            'status' => IssueStatus::Pending->value
        ];

        $validated = Validator::make($input, [
            'usecase_id' => ['required', 'integer'],
            'email' => ['sometimes', 'email', 'max:255'],
            'message' => ['required', 'string'],
            'status' => ['integer']
        ])->validate();

        $issue = Issue::create($validated);

        Mail::to(Setting::mail_from_address())->queue(new IssueReceived($issue));

        $this->sent = true;
        session()->flash('status', 'Thank you for getting in touch. We will investigate and get back to you.');
    }

    public function render()
    {
        return view('livewire.issue-modal');
    }

    private function initiate()
    {
        $this->showingModal = false;
        $this->mount();
    }
}
