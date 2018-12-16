@extends('layouts.app')

@section('content')

    <main class="app-content py-3">
        <div class="container">
            @section('inner_content')
                @include ('cabinet._nav', ['page' => ''])
                <p>Личный кабинет пользователя</p>
            @show
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="border-top pt-3">
                <p>&copy; {{ date('Y') }} - Links</p>
            </div>
        </div>
    </footer>

@endsection