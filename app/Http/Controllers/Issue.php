<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Issue extends Controller
{
    /**
     * Reads a given Issue
     * @param \App\Models\Issue $issue
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function read(\App\Models\Issue $issue)
    {
        return view('tas/issue/read', ['issue' => $issue]);
    }

    /**
     * Lists Issues
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function list()
    {
        $issues = \App\Models\Issue::paginate(10);
        return view('tas/issue/list', ['issues' => $issues]);
    }

    /**
     * Resolves a given Issue
     * @param \App\Models\Issue $issue
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resolve(\App\Models\Issue $issue)
    {
        $issue->resolve()->save();
        return redirect(route('issue.list'))->with('status', 'Issue is marked as resolved.');
    }
}
