@extends('layouts.welcome', ['title' => "Главная страница"])



@section('content')
    <div class="flex-center position-ref full-height">


        <div class="content">
            <div class="links">

                <a href="{{route('authors')}}">Авторы</a>
                <a href="{{route('books')}}">Книги</a>
                <a href="{{route('')}}">Поиск</a>
            </div>
        </div>
    </div>
@endsection