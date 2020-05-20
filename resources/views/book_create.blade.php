@extends('layouts.welcome', ['title' => "Создать книгу"])



@section('content')
    <form action="{{route('store_book')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label class="switch">
                Название
            </label>
            <input type="text" id="title" name="title">
            @if($errors->has('title'))
                <font color="red"><p>  {{$errors->first('title')}}</p></font>
            @endif
        </div>
        <br>
        <label class="switch">
            Авторы <br>
        </label>
        @foreach($authors as $item)
            <input class="form-check-input" type="checkbox" value="{{$item->id}}" name="authors[]">
            {{$item->first_name}}   {{$item->last_name}}
            <br>
        @endforeach
        <br>
        <button class="btn btn-primary">Создать анкету</button>
        <a class="btn btn-success" href="{{route('main')}}">Назад</a> </b>
    </form>
@endsection