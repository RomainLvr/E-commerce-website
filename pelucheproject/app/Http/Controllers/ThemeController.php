<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{


    public function setTheme(Request $request)
    {
        $theme = $request->themeSet;
        $request->session()->put('themeSet', $theme);
        return redirect()->back();
    }
}
