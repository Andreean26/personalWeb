<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\portofolio;

class WebPortofolioController extends Controller
{
    //
    public function index()
    {
        $portofolios = portofolio::all();
        return view('myweb', ['portofolios' => $portofolios]);
    }
}
