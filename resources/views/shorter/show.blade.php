@extends('layouts.app')

@section('content')

<div class="container">
    <a href="{{ route('cabinet.links') }}" class="btn btn-primary mb-5">Back</a>

    <table class="table">
        <tr>
            <th scope="row">Link:</th>
            <td>{{ url($link->short_url) }}</td>
        </tr>
        <tr>
            <th scope="row">Original link:</th>
            <td>{{ $link->url }}</td>
        </tr>
    </table>
    <p><a href="{{ route('register') }}">Register</a> for detailed statistics (in your cabinet and only your links).</p>
</div>


@endsection