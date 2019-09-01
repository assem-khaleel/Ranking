<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


class ChartController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        if (Auth::user()->institutionUser && Auth::user()->programs->isEmpty()) {

            return view('dashboard.org-chart');
        }
        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => 'common.permission']);
    }
}
