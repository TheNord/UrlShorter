<?php

namespace App\UseCases\Shorter;

use App\Link;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShorterService
{
    public function create($url, $userId)
    {
        $shortUrl = str_random(8);

        $link = Link::create([
            'url' => $url,
            'short_url' => $shortUrl,
            'user_id' => $userId,
        ]);

        // создаем новую запись в истории просмотров
        $link->stats()->create([
            'date' => Carbon::now()
        ]);

        return $link;
    }

    public function getFullUrl(Request $request)
    {
        // получаем сокращенную ссылку из запроса
        $url = $request->path();

        // находим в базе модель по сокр. ссылке
        $fullUrl = Link::whereShortUrl($url)->firstOrFail();

        // добавляем просмотр
        $this->addViewToStatistics($fullUrl);

        return $fullUrl->url;
    }

    public function addViewToStatistics(Link $link)
    {
        // добавляем просмотр к общему числу просмотров
        $link->addView();

        // добавляем просмотр к статистике по дням
        $lastStats = $link->stats()->orderBy('date', 'desc')->first();

        // если последняя запись в истории сделана не сегодня, то добавим новую
        if ($lastStats->date !== Carbon::now()->format('Y-m-d')) {
            $link->stats()->create([
                'date' => Carbon::now(),
                'views' => 1,
            ]);
        } else {
            // если последняя запись в истории сделана сегодня, то добавим просмотр
            $lastStats->increment('views');
        }
    }
}