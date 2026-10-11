<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingPageSetting;

class BusinessController extends Controller
{
    /**
     * Display Mobility business pillar page
     */
    public function mobility()
    {
        return view('pages.business.mobility');
    }

    /**
     * Display Industry 4.0 business pillar page
     */
    public function industry()
    {
        return view('pages.business.industry');
    }

    /**
     * Display Energy Solution business pillar page
     */
    public function energy()
    {
        return view('pages.business.energy');
    }

    /**
     * Display Well-being business pillar page
     */
    public function wellbeing()
    {
        return view('pages.business.wellbeing');
    }

    /**
     * Display Technology page
     */
    public function technology()
    {
        return view('pages.business.technology');
    }

    /**
     * Display Innovation page
     */
    public function innovation()
    {
        return view('pages.business.innovation');
    }
}
