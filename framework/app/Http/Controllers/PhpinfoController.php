<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhpinfoController extends Controller
{
    public function show(Request $request)
    {
        ob_start();
        phpinfo();
        $data = ob_get_contents();
        ob_clean();

        return response()->json(["raw" => $data]);

    }
}
