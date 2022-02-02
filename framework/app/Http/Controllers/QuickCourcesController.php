<?php

namespace App\Http\Controllers;

use App\Models\Cource;
use App\Models\ImageList;
use Illuminate\Http\Request;
use Symfony\Component\Yaml\Yaml;

class QuickCourcesController extends Controller
{
    public function index(Request $request)
    {
		// TODO Разобраться с запросом дочерних моделей через pivot синтаксис, выбирать нужные поля непосредственно с помощью БД
		//  Форкнуть репу с ClosureTable и исправить функциональность
        $yamlCources = Yaml::parse(file_get_contents(base_path() . '/resources/js/QuickCources.yaml'));
        $cources_array = [];
        $cources = Cource::find(1)->getDescendants()->where('isLeaf', 1);
        foreach ($cources as &$cource) {
            $cource_array = $cource->only(['parent_id', 'title', 'slug', 'header', 'description', 'css_color', 'css_color_background', 'component', 'button_caption', 'options']);
            $cource_array['images']=[];
            $images = ImageList::with('images')->find(['image_list_id ' => $cource->image_list->id])->first()->images->toArray();
            foreach ($images as &$image) {
                $cource_array['images'][$image['pivot']['tag']]=$image;
                unset($cource_array['images'][$image['pivot']['tag']]['pivot']);
            }
            $cources_array[$cource->id] = $cource_array;
        }
        return response()->json(["raw" => $cources_array]);
    }
}
