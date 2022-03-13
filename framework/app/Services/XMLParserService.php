<?php

namespace App\Services;

use App\Models\NewsExternal;
use App\Models\NewsTopicExternal;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Orchestra\Parser\Xml\Facade as XmlParser;

class XMLParserService
{
    public function saveNews($link)
    {
        $xml = XmlParser::load($link);
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
        return $rss;
    }
}
