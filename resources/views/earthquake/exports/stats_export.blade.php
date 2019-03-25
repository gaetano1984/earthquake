<table>
	<thead>
		<tr>
			<th>ID</th>
			<th>Data</th>
			<th>Luogo</th>
			<th>Magnitudo</th>
			<th>Latitudine</th>
			<th>Longitudine</th>
		</tr>
	</thead>
	<tbody>
		@foreach($earthquake as $e)
			<tr>
				<td>{{$e->id}}</td>
				<td>{{Carbon\Carbon::parse($e->creationTime)->format('Y-m-d')}}</td>
				<td>{{$e->name}}</td>
				<td>{{$e->magnitude}}</td>
				<td>{{$e->latitude}}</td>
				<td>{{$e->longitude}}</td>
			</tr>
		@endforeach
	</tbody>
</table>