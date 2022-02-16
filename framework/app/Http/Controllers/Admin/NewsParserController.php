<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

                    break;
            }
            return response()->json(["raw" =>  ($rss === null ) ? [] : $rss]);
        }

    }
}
