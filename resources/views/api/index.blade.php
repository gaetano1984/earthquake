@extends('layout')

@section('body')
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<div class="col-md-12 pull-right">
			Gestione API
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 pull-right">
				<div class="float-right">
					<a href="{{route('api_create')}}">
						<button class="btn btn-info">crea API</button>
					</a>
				</div>
			</div>
			<div class="col-md-12 pull-right">
				<table class="table" border=1>
					<thead>
						<tr>
							<th>
								Url
							</th>
							<th>
								
							</th>
						</tr>
					</thead>
					<tbody>
						@if(count($api)==0)
							<tr>
								<td colspan=2>
									Non sono presenti API attive
								</td>
							</tr>
						@endif
					</tbody>
				</table>	
			</div>
		</div>
	</div>
@endsection