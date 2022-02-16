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
use Orchestra\Parser\Xml\Facade as XmlParser;

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
                        } else {
                            $item->update($item_arr);
                        }
                        $item->save();
                    }

                    break;
            }
            return response()->json(["raw" => ($rss === null) ? [] : $rss]);
        }

    }
}
