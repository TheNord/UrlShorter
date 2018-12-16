<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabinetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cabinet.index');
    }

    public function links()
    {
        // получаем ссылки пользователя
        $links = Link::whereUserId(Auth::id())->get();

        return view('cabinet.links', compact('links'));
    }
}
