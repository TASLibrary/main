<?php

namespace App\Http\Livewire;

use App\Enum\EvaluationStatus;
use App\Mail\EvaluationReceived;
use App\Models\Evaluation;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class EvaluationBlock extends Component
{
    public int $usecase_id;

    public int $user_id;

    public int $usage_likelihood_rating;

    public string $usage_likelihood_reason;

    public string $positive_points;

    public string $negative_points;

    public bool $sent;

    public function submit()
    {
        $this->resetErrorBag();

        $input = [
            'usage_likelihood_rating' => $this->usage_likelihood_rating,
            'usage_likelihood_reason' => $this->usage_likelihood_reason,
            'positive_points' => $this->positive_points,
            'negative_points' => $this->negative_points,
            'user_id' => $this->user_id,
            'usecase_id' => $this->usecase_id,
            'status' => EvaluationStatus::Pending->value
        ];

        $validated = Validator::make($input,
            [
                'usage_likelihood_rating' => ['required', 'integer', 'gte:1', 'lte:5'],
                'usage_likelihood_reason' => ['nullable', 'string'],
                'positive_points' => ['nullable', 'string'],
                'negative_points' => ['nullable', 'string'],
                'user_id' => ['required', 'integer'],
                'usecase_id' => ['required', 'integer'],
                'status' => ['required', 'integer']
            ]
        )->validate();

        $evaluation = Evaluation::create($validated);

        Mail::to(Setting::mail_from_address())->queue(new EvaluationReceived($evaluation));

        $this->sent = true;
    }

    public function mount()
    {
        $this->usage_likelihood_rating = 0;
        $this->usage_likelihood_reason = '';
        $this->positive_points = '';
        $this->negative_points = '';
        $this->sent = false;
    }

    public function render()
    {
        return view('livewire.evaluation-block');
    }
}
