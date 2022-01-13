<?php

namespace App\Http\Controllers;

class PhpinfoController extends Controller
{
    public function show()
    {
        $data = phpinfo();
        return Inertia::render('Custom/PhpInfo', ['data' => $data]);
    }
}
