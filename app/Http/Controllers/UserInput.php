<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserInput extends \App\Http\Controllers\Controller
{
    /**
     * Creates a UserInput
     * @param Request $request
     * @param \App\Models\Dimension $dimension
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request, \App\Models\Dimension $dimension)
    {
        if ($request->getMethod() == 'POST') {
            Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:1023'],
            ])->validate();

            $user_input = \App\Models\UserInput::create([
                'name' => $request->post('name'),
                'dimension_id' => $dimension->id,
                'user_created' => false
            ]);

            return redirect()->to(route('user_input.list', [$dimension->id]))->with('status', "User Input '$user_input->name' was created.");
        }
        else {
            return view('tas/user_input/create', ['dimension' => $dimension]);
        }
    }

    /**
     * Updates a given UserInput
     * @param Request $request
     * @param \App\Models\UserInput $user_input
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, \App\Models\UserInput $user_input)
    {
        if ($request->getMethod() == 'POST') {
            Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:1023'],
            ])->validate();

            $user_input->name = $request->post('name');
            $user_input->save();

            return redirect()->to(route('user_input.list', [$user_input->dimension_id]))->with('status', "User Input '$user_input->name' was updated.");
        }
        else {
            return view('tas/user_input/update', ['user_input' => $user_input]);
        }
    }

    /**
     * Deletes a given UserInput
     * @param Request $request
     * @param \App\Models\UserInput $user_input
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, \App\Models\UserInput $user_input)
    {
        if ($request->getMethod() == 'POST') {
            $user_input->delete();

            return redirect()->to(route('user_input.list', [$user_input->dimension_id]))->with('status', "User Input '$user_input->name' was deleted.");
        }
        else {
            return view('tas/user_input/delete', ['user_input' => $user_input]);
        }
    }

    /**
     * Lists UserInputs of a given Dimension
     * @param \App\Models\Dimension $dimension
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list(\App\Models\Dimension $dimension)
    {
        $user_inputs = \App\Models\UserInput::where('dimension_id', $dimension->id)->where('user_created', false)->paginate(10);
        return view('tas/user_input/list', ['user_inputs' => $user_inputs, 'dimension' => $dimension]);
    }
}
