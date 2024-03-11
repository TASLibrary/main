<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Evaluation extends Controller
{
    /**
     * Updates a given Evaluation
     * @param Request $request
     * @param \App\Models\Evaluation $evaluation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, \App\Models\Evaluation $evaluation)
    {
        if ($request->getMethod() == 'POST'){
            $validated = $request->validate([
                'usage_likelihood_rating' => ['required', 'integer', 'gte:1', 'lte:5'],
                'usage_likelihood_reason' => ['nullable', 'string'],
                'positive_points' => ['nullable', 'string'],
                'negative_points' => ['nullable', 'string'],
            ]);

            $evaluation->usage_likelihood_rating = $validated['usage_likelihood_rating'];
            $evaluation->usage_likelihood_reason = $validated['usage_likelihood_reason'];
            $evaluation->positive_points = $validated['positive_points'];
            $evaluation->negative_points = $validated['negative_points'];

            $evaluation->save();

            return redirect(route('evaluation.list'))->with('status', 'Evaluation was updated.');
        }
        else{
            return view('tas/evaluation/update', ['evaluation' => $evaluation]);
        }
    }

    /**
     * Reads a given Evaluation
     * @param \App\Models\Evaluation $evaluation
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function read(\App\Models\Evaluation $evaluation)
    {
        return view('tas/evaluation/read', ['evaluation' => $evaluation]);
    }

    /**
     * Lists Evaluations
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        $evaluations = \App\Models\Evaluation::paginate(10);
        return view('tas/evaluation/list', ['evaluations' => $evaluations]);
    }

    /**
     * Approves a given Evaluation and increments user rating
     * @param \App\Models\Evaluation $evaluation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(\App\Models\Evaluation $evaluation)
    {
        $evaluation->approve()->save();
        $evaluation->user->incrementRating();
        return redirect()->to(route('evaluation.list'))->with('status', "Evaluation is now approved and visible publicly.");
    }

    public function reject(\App\Models\Evaluation $evaluation)
    {
        $evaluation->reject()->save();
        $evaluation->user->decrementRating();
        return redirect()->to(route('evaluation.list'))->with('status', "Evaluation is now rejected and not visible publicly.");
    }
}
