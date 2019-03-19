@extends('layouts.app')

@section('content')
    <h3>Editar categoria</h3>
    @include('form._form_errors')
    {{ Form::model($category,['route' => ['app.categories.update',$category->uuid], 'method' => 'PUT' ]) }}
        @include('app.category._form')
        <button type="submit" class="btn btn-primary">Salvar</button>
    {{ Form::close() }}
@endsection