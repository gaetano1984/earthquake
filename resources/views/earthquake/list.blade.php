@extends('layout')

@section('body')
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<table class="table table-striped" border=1>
				<thead>
					<tr>
						<th>
							{{__('earthquake.list.header.quake_id')}}
						</th>
						<th>
							{{__('earthquake.list.header.location')}}
						</th>
						<th>
							{{__('earthquake.list.header.creationTime')}}
						</th>
						<th>
							{{__('earthquake.list.header.magnitude')}}
						</th>
					</tr>
				</thead>
				<tbody>
					@foreach($res as $e)
						<tr>
							<td>
								{{$e->id_earthquake}}
							</td>
							<td>
								{{$e->location}}
							</td>
							<td>
								{{$e->creationTime}}
							</td>
							<td>
								{{$e->magnitude}}
							</td>
						</tr>
					@endforeach		
				</tbody>
			</table>		
		</div>
		<div class="row">
			<div class="col-md-12 text-center">
				{{$res->links('pagination::bootstrap-4')}}
			</div>
		</div>
	</div>
@endsection