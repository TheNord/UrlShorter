<?php

namespace App\Http\Controllers;

use App\UseCases\Shorter\ShorterService;
use Illuminate\Http\Request;
use App\Link;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ShorterController extends Controller
{
    private $service;

    public function __construct(ShorterService $service)
    {
        $this->service = $service;
    }

    /** Отображаем краткую информацию для пользователей просматривающих детали от гостя
     *  и полную информацию для авторизованного автора ссылки
     */
    public function show(Link $link)
    {
        if ($link->user_id === Auth::id() && Auth::check()) {
            return redirect()->route('shorter.detail', $link);
        } else {
            return view('shorter.show', compact('link'));
        }
    }

    public function showFull(Link $link)
    {
        $this->checkAccess($link);

        return view('cabinet.show', compact('link'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $link = $this->service->create($request['url'], Auth::id());

        return redirect()->route('shorter.show', $link);
    }

    /** Метод переадрессации на полный адрес */
    public function redirectUrl(Request $request)
    {
        $url = $this->service->getFullUrl($request);

        return redirect($url);
    }

    public function statistic(Link $link)
    {
        $this->checkAccess($link);

        $dates = $link->stats()->get();

        // получаем массив дат и преобразуем под хайчартс
        $datesArray = $dates->pluck('date')->toArray();
        $datesResult = "'" . implode("', '", $datesArray) . "'";

        // получаем массив просмотров и преобразуем под хайчартс
        $viewsArray = $dates->pluck('views')->toArray();
        $viewsResult = implode(', ', $viewsArray);

        return view('shorter.stats', compact('link', 'dates', 'datesResult', 'viewsResult'));
    }

    private function checkAccess(Link $link): void
    {
        if (!Gate::allows('manage-own-links', $link)) {
            abort(404);
        }
    }

}
