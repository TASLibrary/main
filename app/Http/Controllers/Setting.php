<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Setting extends Controller
{
    /**
     * Updates all Setting records after validation
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request)
    {
        $settings = \App\Models\Setting::all();
        foreach ($settings as $setting){
            Validator::make(
                [$setting->name => $request->post($setting->name)],
                [$setting->name => $setting->validation]
            )->validate();

            $setting->value = $request->post($setting->name);
            $setting->save();
        }

        return redirect(route('setting.list'))->with('status', 'Changes were saved.');
    }

    /**
     * Lists Settings
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        $settings = \App\Models\Setting::all();
        return view('tas/setting/list', ['settings' => $settings]);
    }
}
