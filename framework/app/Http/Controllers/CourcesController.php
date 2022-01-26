<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Yaml\Yaml;

class CourcesController extends Controller
{
    public function index(Request $request)
    {
        $yamlCources = Yaml::parse(file_get_contents(base_path() . '/resources/js/SliderCources.yaml'));
        $cources = [];
        YamlRouteList($yamlCources, $cources);
        $cources = array_slice($cources, 1);

        return response()->json(["raw" => $cources]);

    }
}
