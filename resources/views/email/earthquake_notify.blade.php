@extends('email.layout_email')

@section('body')
	Gentile {{$user->name}} {{$user->surname}}
	<br>
	La informiamo che sono stati registrati i seguenti eventi:
	<br>
	<table class="table" border=1>
		<thead>
			<tr>
				<th>Luogo</th>
				<th>Data</th>
				<th>Magnitudo</th>
			</tr>
		</thead>
		<tbody>
			@foreach($quake as $q)
				<tr>
					<td>{{$q['location']}}</td>
					<td>{{$q['creationTime']}}</td>
					<td>{{$q['magnitude']}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
