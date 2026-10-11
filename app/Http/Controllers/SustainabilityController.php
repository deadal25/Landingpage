<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SustainabilityController extends Controller
{
    /**
     * Display Sustainability, Green Factory, and ESG page.
     */
    public function index()
    {
        return view('pages.sustainability.index');
    }
}
