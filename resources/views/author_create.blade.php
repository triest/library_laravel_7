@extends('layouts.welcome', ['title' => "Создать автора"])
@section('content')
    <div class="container">
        <form action="{{route('store_author')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
                <label class="control-label col-sm-2">
                    Имя
                </label>
                <input class="form-control  col-sm-3" type="text" id="first_name" name="first_name">
                @if($errors->has('first_name'))
                    <font color="red"><p>  {{$errors->first('first_name')}}</p></font>
                @endif
            </div>
            <br>
            <div class="form-group row">
                <label class="control-label col-sm-2">
                    Фамилия
                </label>
                <input class="form-control  col-sm-3" type="text" id="last_name" name="last_name">
                @if($errors->has('last_name'))
                    <font color="red"><p>  {{$errors->first('last_name')}}</p></font>
                @endif
            </div>
            <br>
            <button class="btn btn-primary">Создать автора</button>
            <a class="btn btn-success" href="{{route('main')}}">Назад</a> </b>
        </form>
        <table class="table">
            <thead>
            <tr>
                <th>
                    Фамилия
                </th>
                <th>
                    Имя
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($authors as $author)
                <tr>
                    <td>
                        {{$author->last_name}}
                    </td>
                    <td>
                        {{$author->first_name}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $authors->links() }}
    </div>
@endsection