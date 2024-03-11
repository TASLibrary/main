<?php

namespace App\Http\Livewire;

use App\Enum\UsecaseStatus;
use App\Models\Usecase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SearchBlock extends Component
{
    public string $search;

    public array $sortBy;

    public array $selected_characteristics;

    public Collection $usecases;

    public Collection $dimensions;

    public function search()
    {
        $this->dispatchBrowserEvent('reEnforceSelect2');

        $this->usecases = Usecase::where('status', UsecaseStatus::Approved->value)->
        where('title', 'like', '%'.$this->search.'%')->
        orWhere('description', 'like', '%'.$this->search.'%')->
        orWhere('source', 'like', '%'.$this->search.'%')->
        orWhere('standout_characteristics', 'like', '%'.$this->search.'%')->
        orWhere('limitations', 'like', '%'.$this->search.'%')->
        orWhere('rri', 'like', '%'.$this->search.'%')->
        get();

        if (count($this->selected_characteristics) > 0 && count($this->usecases) > 0){
            $this->usecases = $this->usecases->toQuery()->whereHas('characteristics', function (Builder $query) {
                $query->whereIn('id', $this->selected_characteristics);
            })->get();
        }
    }

    public function sort(string $field, int $sort_type)
    {
        $this->dispatchBrowserEvent('reEnforceSelect2');

        $descending = !(($sort_type == 0 || $sort_type == 1));

        switch ($field){
            case 'title':
                $this->usecases = $this->usecases->sortBy('title', SORT_NATURAL | SORT_FLAG_CASE, $descending)->values();
                break;
            case 'contributor':
                $this->usecases = $this->usecases->sortBy(
                    function($usecase) {return $usecase->user->name;},
                    SORT_NATURAL | SORT_FLAG_CASE,
                    $descending)->values();
                break;
            case 'user_rating':
                $this->usecases = $this->usecases->sortBy(
                    function($usecase) {return $usecase->user->rating;},
                    SORT_NUMERIC,
                    $descending)->values();
                break;
        }
    }

    public function filterByCharacteristics()
    {

    }

    private function query()
    {
        return Usecase::where('status', UsecaseStatus::Approved->value);
    }

    private function orderBy(string $field, int $order_type)
    {
        $descending = ($order_type == 0 || $order_type == 1) ? false : true;

        if ($descending){

        }
        else{

        }
//        switch ($field){
//            case 'title':
//
//                break;
//            case 'user':
//
//                break;
//            case 'user_rating':
//                break;
//        }
    }

    public function mount()
    {
        $this->sortBy = [];
        $this->selected_characteristics = [];
        $this->search = '';
        $this->dispatchBrowserEvent('reEnforceSelect2');
    }

    public function render()
    {
        return view('livewire.search-block');
    }
}
