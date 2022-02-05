@extends('layout.app')

@section('body')
<h1>{{ $name }}</h1>
@isset($age)
    @if ($age>10)
        <h5>{{ $name }}</h5>
    @endif
@endisset
@isset($articles)
<div class="row justy-content-center">//pour mettre des chose en ligne
@foreach ($articles as $article )
    <x-article
        title="{{ $article['title'] }}"
        description="{{ $article['description'] }}"
        icon="{{ $article['icon'] }}"
    />
@endforeach
</div>
@endisset
@endsection
