<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Usecase extends Controller
{
    /**
     * Updates a give Usecase
     * @param Request $request
     * @param \App\Models\Usecase $usecase
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, \App\Models\Usecase $usecase)
    {
        if ($request->getMethod() == 'POST') {


            $validated = $request->validate([
                'title' => ['required', 'string', 'max:511'],
                'description' => ['required', 'string'],
                'source' => ['required', 'string', 'max:511'],
                'standout_characteristics' => ['required', 'string', 'max:511'],
                'origin' => ['required', 'integer'],
                'limitations' => ['required', 'string', 'max:511'],
                'link' => ['nullable', 'url'],
                'acknowledgement' => ['required', 'integer'],
                'rri' => ['nullable', 'string']
            ]);

            $usecase->title = $validated['title'];
            $usecase->description = $validated['description'];
            $usecase->source = $validated['source'];
            $usecase->standout_characteristics = $validated['standout_characteristics'];
            $usecase->origin = $validated['origin'];
            $usecase->limitations = $validated['limitations'];
            $usecase->link = $validated['link'];
            $usecase->acknowledgement = $validated['acknowledgement'];
            $usecase->rri = $validated['rri'];

            $new_characteristics = collect(explode(',', $request->post('characteristics')))->diff(['0']);

            $current_characteristics = $usecase->characteristics->where('public', false)->pluck('id');

            foreach ($new_characteristics->diff($current_characteristics)->toArray() as $characteristic_id) {
                $usecase->characteristics()->attach($characteristic_id);
            }

            foreach ($current_characteristics->diff($new_characteristics)->toArray() as $characteristic_id) {
                $usecase->characteristics()->detach($characteristic_id);
            }

            $usecase->save();

            return redirect(route('usecase.list'))->with('status', 'Usecase was updated.');
        }
        else{
            $dimensions = \App\Models\Dimension::all();
            return view('tas/usecase/update', ['usecase' => $usecase, 'dimensions' => $dimensions]);
        }
    }

    /**
     * Reads a given Usecase
     * @param \App\Models\Usecase $usecase
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function read(\App\Models\Usecase $usecase)
    {
        return view('tas/usecase/read', ['usecase' => $usecase]);
    }

    /**
     * Lists Usecases
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        $usecases = \App\Models\Usecase::paginate(10);

        return view('tas/usecase/list',  ['usecases' => $usecases]);
    }

    /**
     * Approves a given Usecase and increases the user rating
     * @param \App\Models\Usecase $usecase
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function approve(\App\Models\Usecase $usecase)
    {
        $usecase->approve()->save();
        $usecase->user->incrementRating();
        return redirect(route('usecase.list'))->with('status', "Usecase '$usecase->title' is now approved and visible publicly.");
    }

    /**
     * Rejects a given Usecase and decreases user rating
     * @param \App\Models\Usecase $usecase
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function reject(\App\Models\Usecase $usecase)
    {
        $usecase->reject()->save();
        $usecase->user->decrementRating();
        return redirect(route('usecase.list'))->with('status', "Usecase '$usecase->title' is now rejected and not visible publicly.");
    }

    /**
     * Features a given Usecase to be shown on the home page
     * @param \App\Models\Usecase $usecase
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function feature(\App\Models\Usecase $usecase)
    {
        $oldFeaturedUsecase = \App\Models\Usecase::where('featured', true)->get();
        if (!$oldFeaturedUsecase->isEmpty()){
            $oldFeaturedUsecase->first()->unfeature()->save();
        }

        $usecase->feature()->save();
        return redirect(route('usecase.list'))->with('status', "Usecase '$usecase->title' is now featured on the home page.");
    }
}
