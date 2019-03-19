@extends('layouts.app')

@section('content')
    <h3>Listagem de categorias</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <td>
                <a class="btn btn-primary" href="{{ route('app.categories.create') }}">Criar novo</a>
            </td>
        </tr>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ação</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->uuid }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{route('app.categories.edit',['category' => $category->uuid])}}">Editar</a> |
                    <a href="{{route('app.categories.show',['category' => $category->uuid])}}">Ver</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection