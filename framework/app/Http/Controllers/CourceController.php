<?php

namespace App\Http\Controllers;

use App\Models\Cource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Symfony\Component\Yaml\Yaml;

class CourceController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make(['slug' => $request->slug], [
            'slug' => ['required', 'max:60'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors(['message' => "Что-то пошло не так."]);

        } else {

            $cource = Cource::firstWhere([
                ['isLeaf', 1],
                ['slug', $request->slug]]);
            if ($cource !== null) {

                $yamlMenu = Yaml::parse(file_get_contents(base_path() . '/resources/js/menu.yaml'));
                $menu = [];
                YamlRouteList($yamlMenu, $menu);

                return Inertia::render('Cource', [
                    'title' => $cource->title,
                    'menu' => $menu,
                ]);
            } else {
                return Redirect::back()->withErrors(['message' => "Что-то пошло не так."]);

            }
        }
    }
}
