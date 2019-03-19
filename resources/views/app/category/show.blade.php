@extends('layouts.app')

@section('content')
    <h3>Ver categoria</h3>
    <a class="btn btn-primary" href="{{ route('app.categories.edit',['category' => $category->uuid]) }}">Editar</a>
    <a class="btn btn-danger" href="{{ route('app.categories.destroy',['category' => $category->uuid]) }}"
       onclick="event.preventDefault();if(confirm('Deseja excluir este item?')){document.getElementById('form-delete').submit();}">Excluir</a>
    {{Form::open(['route' => ['app.categories.destroy',$category->uuid],'method' => 'DELETE', 'id' => 'form-delete'])}}
    {{Form::close()}}
    <br/><br/>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th scope="row">ID</th>
            <td>{{$category->uuid}}</td>
        </tr>
        <tr>
            <th scope="row">Nome</th>
            <td>{{$category->name}}</td>
        </tr>
        </tbody>
    </table>
@endsection