@extends('cabinet.index')

@section('inner_content')
    @include ('cabinet._nav', ['page' => 'links'])
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Url</th>
            <th>ShortUrl</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($links as $link)
            <tr>
                <td>{{ $link->url }}</td>
                <td>{{ url($link->short_url) }}</td>
                <td><a href="{{ route('shorter.detail', $link) }}">Detail</a></td>
            </tr>
        @endforeach

        </tbody>
    </table>

@endsection