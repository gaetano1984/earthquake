@extends('layout')

@section('body')
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<table class="table table-striped" border=1>
				<thead>
					<tr>
						<td colspan=3>&nbsp;</td>
						<td>
							<select class="form-control" id="limit" name="limit">
								<option @if($limit==5)  selected @endif>5</option>
								<option @if($limit==10) selected @endif>10</option>
								<option @if($limit==20) selected @endif>20</option>
							</select>			
						</td>
					</tr>
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
								{{$e->name}}
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

@section('extrascripts')
<script type="text/javascript">
	$('#limit').on('change', function(){
		limit = $(this).val();
		window.location.href = "{{route('quake_list')}}/"+limit;
	});
</script>
@endsection