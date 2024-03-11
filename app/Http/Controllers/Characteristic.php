<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Characteristic extends Controller
{

    /**
     * Creates a new Characteristic
     * @param Request $request
     * @param \App\Models\Dimension $dimension
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request, \App\Models\Dimension $dimension)
    {
        if ($request->getMethod() == 'POST') {

            Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:2048'],
                'description' => ['required', 'string', 'max:4096'],
            ])->validate();

            $characteristic = \App\Models\Characteristic::create([
                'name' => $request->post('name'),
                'description' => $request->post('description'),
                'dimension_id' => $dimension->id,
            ]);

            return redirect()->to(route('characteristic.list', [$dimension->id]))->with('status', "Characteristic '$characteristic->name' was created.");
        }
        else{
            $characteristics = \App\Models\Characteristic::where('dimension_id', $dimension->id)->get();
            return view('tas/characteristic/create', ['dimension' => $dimension, 'characteristics' => $characteristics]);
        }
    }

    /**
     * Updates a given Characteristic
     * @param Request $request
     * @param \App\Models\Characteristic $characteristic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, \App\Models\Characteristic $characteristic)
    {
        if ($request->getMethod() == 'POST') {
            Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:2048'],
                'description' => ['required', 'string', 'max:4096'],
            ])->validate();

            $characteristic->name = $request->post('name');
            $characteristic->description = $request->post('description');
            $characteristic->save();

            return redirect()->to(route('characteristic.list', [$characteristic->dimension_id]))->with('status', "Characteristic '$characteristic->name' was updated.");
        }
        else{
            $characteristics = \App\Models\Characteristic::where('dimension_id', $characteristic->dimension_id)->get();
            return view('tas/characteristic/update', ['characteristic' => $characteristic, 'characteristics' => $characteristics]);
        }
    }

    /**
     * Deletes a given Characteristic
     * @param Request $request
     * @param \App\Models\Characteristic $characteristic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, \App\Models\Characteristic $characteristic)
    {
        if ($request->getMethod() == 'POST') {
            $characteristic->delete();
            return redirect()->to(route('characteristic.list', [$characteristic->dimension_id]))->with('status', "Characteristic '$characteristic->name' was deleted.");
        }
        else{
            return view('tas/characteristic/delete', ['characteristic' => $characteristic]);
        }
    }

    /**
     * Lists Characteristics of a given Dimension
     * @param \App\Models\Dimension $dimension
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list(\App\Models\Dimension $dimension)
    {
        $characteristics = \App\Models\Characteristic::where('dimension_id', $dimension->id)->paginate(10);
        return view('tas/characteristic/list', [
            'dimension' => $dimension,
            'characteristics' => $characteristics
        ]);
    }
}
