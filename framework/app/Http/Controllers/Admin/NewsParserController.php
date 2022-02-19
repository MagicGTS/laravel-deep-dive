<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsExternal;
use App\Models\NewsTopicExternal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Symfony\Component\Yaml\Yaml;

class NewsParserController extends Controller
{
    public function parse(Request $request)
    {
        $validator = Validator::make(['source' => $request->source], [
            'source' => ['required', 'max:60'],
        ]);
        if ($validator->fails()) {
            return Redirect::route('Index')->withErrors(['message' => "Что-то пошло не так."]);
        } else {
            $rss = null;
            switch ($request->source) {
                case 'mintrud':
                    $xml = XmlParser::load(base_path() . '/resources/js/official.rss');
                    $rss = $xml->parse([
                        'title' => [
                            'uses' => 'channel.title',
                        ],
                        'link' => [
                            'uses' => 'channel.link',
                        ],
                        'description' => [
                            'uses' => 'channel.description',
                        ],
                        'items' => [
                            'uses' => 'channel.item[title,link,category,description,guid,pubDate]',
                        ],
                    ]);
                    $topic = NewsTopicExternal::updateOrCreate(Arr::except($rss, ['items']));
                    $topic->save();
                    foreach ($rss['items'] as $item_arr) {
                        $item_arr['pubDate'] = Carbon::createFromFormat('D, d M Y H:i:s P', $item_arr['pubDate']); //Wed, 16 Feb 2022 13:10:37 +0000
                        $item = NewsExternal::where('guid', '=', $item_arr['guid'])->first();
                        if ($item === null) {
                            $item = new NewsExternal($item_arr);
                            $item->topic()->associate($topic);
                            $item->save();
                        } else {
                            $item->update($item_arr);
                        }
                    }

                    break;
            }
            return response()->json(["raw" => ($rss === null) ? [] : $rss]);
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
