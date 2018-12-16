@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{ route('cabinet.links') }}" class="btn btn-primary mb-5">Back</a>

    <table class="table">
        <tr>
            <th scope="row">Link:</th>
            <td>{{ url($link->short_url) }} </td>
        </tr>
        <tr>
            <th scope="row">Original link:</th>
            <td>{{ $link->url }}</td>
        </tr>
        <tr>
            <th scope="row">Views</th>
            <td>{{ $link->views }}</td>
        </tr>
        <tr>
            <th scope="row">Statitstic</th>
            <td><a href="{{ route('shorter.statistic', $link) }}">Show</a></td>
        </tr>
    </table>
</div>


@endsection