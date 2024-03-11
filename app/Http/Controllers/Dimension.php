<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Dimension extends Controller
{
    /**
     * Creates a Dimension
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        if ($request->getMethod() == 'POST'){
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:2048'],
                'question' => ['required', 'string', 'max:2048'],
                'description' => ['required', 'string', 'max:4096'],
                'input_type' => ['required', 'int']
            ]);

            $dimension = \App\Models\Dimension::create($validated);

            return redirect()->to(route('dimension.list'))->with('status', "Dimension '$dimension->name' was created.");
        }
        else{
            return view('tas/dimension/create');
        }
    }

    /**
     * Updates a given Dimension
     * @param Request $request
     * @param \App\Models\Dimension $dimension
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, \App\Models\Dimension $dimension)
    {
        if ($request->getMethod() == 'POST') {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:2048'],
                'question' => ['required', 'string', 'max:2048'],
                'description' => ['required', 'string', 'max:4096'],
                'input_type' => ['required', 'int']
            ]);

            $dimension->name = $validated['name'];
            $dimension->description = $validated['description'];
            $dimension->question = $validated['question'];
            $dimension->input_type = $validated['input_type'];

            $dimension->save();

            return redirect()->to(route('dimension.list'))->with('status', "Dimension '$dimension->name' was updated.");
        }
        else{
            return view('tas/dimension/update', ['dimension' => $dimension]);
        }
    }

    /**
     * Deletes a given Dimension
     * @param Request $request
     * @param \App\Models\Dimension $dimension
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, \App\Models\Dimension $dimension)
    {
        if ($request->getMethod() == 'POST') {
            $dimension->delete();
            return redirect()->to(route('dimension.list'))->with('status', "Dimension '$dimension->name' was deleted.");
        }
        else{
            return view('tas/dimension/delete', ['dimension' => $dimension]);
        }
    }

    /**
     * Lists Dimensions
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        $dimensions = \App\Models\Dimension::paginate(10);
        return view("tas/dimension/list", ['dimensions' => $dimensions]);
    }
}
