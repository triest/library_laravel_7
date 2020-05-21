@extends('layouts.welcome', ['title' => "Создать книгу"])



@section('content')
    <div class="container">
        <form action="{{route('store_book')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
                <label class="control-label col-sm-2">
                    Название:
                </label>
                <input class="form-control  col-sm-3" type="text" id="title" name="title">
                @if($errors->has('title'))
                    <font color="red"><p>  {{$errors->first('title')}}</p></font>
                @endif
            </div>
            <br>
            <div class="form-group ">
                <label class="control-label col-sm-2">
                    Авторы:
                </label><br>
                <label class="control-label col-sm-2">
                    @foreach($authors as $item)
                        <p>
                            <input type="checkbox" value="{{$item->id}}" name="authors[]">
                            {{$item->first_name}}   {{$item->last_name}}
                        </p>
                    @endforeach
                </label>
            </div>
            <br>
            <button class="btn btn-primary">Создать книгу</button>
            <a class="btn btn-success" href="{{route('main')}}">Назад</a> </b>
        </form>


        <table class="table">
            <thead>
            <tr>
                <th>
                    Название книги
                </th>
                <th>
                    Автор
                </th>

            </tr>
            </thead>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td>
                        {{$book->title}}
                    </td>
                    <? $authors = $book->author()->get() ?>
                    <td>
                        @foreach($authors as $author)
                            {{$author->first_name}}   {{$author->last_name}}
                            @if(!$loop->last)
                                ,
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $books->links() }}
    </div>
@endsection