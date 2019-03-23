@extends('layout')

@section('body')
	<div class="container" style="margin-top: 80px;">
		Lo stato di questa API è stato cambiato con successo
		<br>
		<a href="{{route('manage_api')}}">torna indietro</a>
	</div>
@endsection