<?php

namespace App\Http\Livewire;

use App\Models\Dimension;
use App\Models\Usecase;
use App\Models\UserInput;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CreateUseCase extends Component
{
    public $showingModal = false;

    public int $step = 1;

    public int $lastStep = 4;

    public int $firstStep = 1;

    public string $title = '';

    public string $description = '';

    public string $source = '';

    public string $origin = '';

    public string $standout_characteristics = '';

    public string $limitations = '';

    public string $link = '';

    public string $RRI = '';

    public array $selected_user_inputs = [];

    public string $acknowledgement = '';

    public string $message;

    public $dimensions;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->dimensions = $this->loadDimensions();
    }

    public function next()
    {
        $this->resetErrorBag();
        $step = $this->step;

        switch ($step){
            case 1:
                $input = [
                    'title' => $this->title,
                    'description' => $this->description,
                    'source' => $this->source,
                    'standout_characteristics' => $this->standout_characteristics,
                    'origin' => $this->origin,
                    'limitations' => $this->limitations,
                    'link' => $this->link,
                ];
                Validator::make($input, [
                    'title' => ['required', 'string', 'max:511'],
                    'description' => ['required', 'string'],
                    'source' => ['required', 'string', 'max:511'],
                    'standout_characteristics' => ['required', 'string', 'max:511'],
                    'origin' => ['required', 'integer'],
                    'limitations' => ['required', 'string', 'max:511'],
                    'link' => ['sometimes', 'url'],
                ])->validate();
                break;
            case 2:
                break;
            case 3:
                $input = [
                    'acknowledgement' => $this->acknowledgement,
                    'responsible_research_and_innovation_issues' => $this->RRI
                ];
                Validator::make($input, [
                    'acknowledgement' => ['required', 'integer'],
                    'responsible_research_and_innovation_issues' => ['sometimes', 'string']
                ])->validate();
                break;
        }

        if ($this->step < $this->lastStep){
            $this->step++;
        }

        if ($this->step == 2){
            $this->dimensions = $this->loadDimensions();
            $this->dispatchBrowserEvent('reEnforceSelect2');
        }

        if ($this->step == 4){
            $usecase = Usecase::create([
                'title' => $this->title,
                'description' => $this->description,
                'source' => $this->source,
                'origin' => $this->origin,
                'standout_characteristics' => $this->standout_characteristics,
                'limitations' => $this->limitations,
                'link' => $this->link,
                'rri' => $this->RRI,
                'acknowledgement' => $this->acknowledgement,
                'user_id' => Auth::user()->id,
                'status' => 0,
                'featured' => false
            ]);

            foreach ($this->selected_user_inputs as $user_input){
                if (is_numeric($user_input)) {
                    $usecase->user_inputs()->attach($user_input);
                }
                else{
                    $dimension_id = explode(':::', $user_input)[0];
                    $user_input_name = explode(':::', $user_input)[1];
                    $new_input = UserInput::create([
                        'name' => $user_input_name,
                        'dimension_id' => $dimension_id,
                        'user_created' => true
                    ]);
                    $usecase->user_inputs()->attach($new_input);
                }
            }

            $this->message = 'Usecase was added successfully. It is pending approval.';
        }
    }

    public function back()
    {
        if ($this->step > $this->firstStep){
            $this->step--;
        }

        if ($this->step == 1){
            $this->resetErrorBag();
        }

        if ($this->step == 2){
            $this->dimensions = $this->loadDimensions();
            $this->dispatchBrowserEvent('reEnforceSelect2');
        }
    }

    public function showModal()
    {
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    private function loadDimensions()
    {
        return Dimension::all();
    }

    public function render()
    {
        return view('livewire.create-use-case');
    }
}
