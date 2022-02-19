<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsExternal;
use App\Services\XMLParserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Symfony\Component\Yaml\Yaml;
use  App\Jobs\NewsParsing;
class NewsParserController extends Controller
{
    public function parse(Request $request, XMLParserService $parseService)
    {
        $validator = Validator::make(['source' => $request->source], [
            'source' => ['required', 'max:60'],
        ]);
        if ($validator->fails()) {
            return Redirect::route('Index')->withErrors(['message' => "Что-то пошло не так."]);
        } else {
            $rss = null;
            $start = date('c');
            switch ($request->source) {
                case 'mintrud':
                    NewsParsing::dispatch('https://mintrud.gov.ru/news/rss/official');
                    //$rss = $parseService->saveNews(base_path() . '/resources/js/official.rss');

                    break;
            }
            //return response()->json(["raw" => ($rss === null) ? [] : $rss]);
            return response()->json(["start" => $start, "end"=>date('c')]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yamlMenu = Yaml::parse(file_get_contents(base_path() . '/resources/js/menu.yaml'));
        $menu = [];
        YamlRouteList($yamlMenu, $menu);
        $news = NewsExternal::get(['guid', 'title', 'category']);
        return Inertia::render('AdminNewsList', [
            'title' => 'Редактор',
            'menu' => $menu,
            'news' => $news,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request  $newsSubscription
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Illuminate\Http\Request  $newsSubscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $validator = Validator::make(['guid' => $request->guid], [
            'guid' => ['required', 'max:60'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors(['message' => "Что-то пошло не так."]);
        } else {
            $yamlMenu = Yaml::parse(file_get_contents(base_path() . '/resources/js/menu.yaml'));
            $menu = [];
            YamlRouteList($yamlMenu, $menu);
            $news = NewsExternal::where('guid', $request->guid)->first();
            if ($news) {
                return Inertia::render('AdminNewsEditor', [
                    'title' => 'Редактор',
                    'menu' => $menu,
                    'news' => $news,
                ]);
            } else {
                return Redirect::route('NewsList')->withErrors(['message' => "Что-то пошло не так."]);
            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  App\Models\NewsExternal  $newsSubscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news.id' => ['required', 'digits_between:1,20'],
            'news.news_topic_external_id' => ['required', 'digits_between:1,20'],
            'news.title' => ['required', 'string'],
            'news.description' => ['required', 'string'],
            'news.link' => ['required', 'string'],
            'news.category' => ['required', 'string'],
            'news.guid' => ['required', 'string'],
            'news.pubDate' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors(['message' => "Что-то пошло не так."]);

        } else {

            $yamlMenu = Yaml::parse(file_get_contents(base_path() . '/resources/js/menu.yaml'));
            $menu = [];
            YamlRouteList($yamlMenu, $menu);
            $news = NewsExternal::where('guid', $request->news['guid'])->first();
            if ($news) {
                $news->update($request->news);

                return Inertia::render('AdminNewsEditor', [
                    'title' => 'Редактор',
                    'menu' => $menu,
                    'news' => $news,
                ]);
            } else {
                return Redirect::route('NewsList')->withErrors(['message' => "Что-то пошло не так."]);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Illuminate\Http\Request  $newsSubscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }
}
