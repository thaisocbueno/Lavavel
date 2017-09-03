@extends('site.template.template')

@section('content')

<h1 class="title-pg"> Listagem dos Produtos </h1>

<a href="{{route('produtos.index')}}" class="btn btn-primary">
	<span class="glyphicon glyphicon-list-alt"></span> Listagem de Produtos
</a>

@endsection