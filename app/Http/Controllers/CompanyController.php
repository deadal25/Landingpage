<?php

namespace App\Http\Controllers;

use App\Models\Director;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * About Us page
     */
    public function about()
    {
        return view('pages.company.about');
    }

    /**
     * Corporate Message from President & CEO
     */
    public function message()
    {
        return view('pages.company.message');
    }

    /**
     * Musashi Philosophy (Origin, Purpose, Way, Corporate Color)
     */
    public function philosophy()
    {
        return view('pages.company.philosophy');
    }

    /**
     * Global Vision (100th Year Vision)
     */
    public function vision()
    {
        return view('pages.company.vision');
    }

    /**
     * Company Outline & Plant specifications
     */
    public function outline()
    {
        return view('pages.company.outline');
    }

    /**
     * Board Of Directors
     */
    public function bod()
    {
        $directors = Director::ordered()->get();
        return view('pages.company.bod', compact('directors'));
    }

    /**
     * Global & Domestic Network
     */
    public function network()
    {
        return view('pages.company.network');
    }
}
