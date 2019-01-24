@extends('layout')

@section('body')
	<div class="container" style="margin-top: 80px;">
		Il tuo profilo è stato aggiornato correttamente
		<br>
		<a href="{{url('user_profile')}}">torna indietro</a>
	</div>
@endsection