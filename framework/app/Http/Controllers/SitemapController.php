<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Yaml\Yaml;

class SitemapController extends Controller
{
    public function index(Request $request)
    {
        $yamlMenu = Yaml::parse(file_get_contents(base_path() . '/resources/js/SiteNav.yaml'));
        $menu = [];
        $section = $request->query('section');

        YamlRouteList($yamlMenu, $menu, [], $section);
        return response()->json(["raw" => $menu]);

    }
}
