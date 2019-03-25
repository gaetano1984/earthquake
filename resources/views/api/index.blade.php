@extends('layout')

@section('body')
	<div class="container" style="margin-top: 80px;">
		<div class="row">
			<div class="col-md-12 pull-right">
			{{__('api.manage.title')}}
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 pull-right">
				<div class="float-right">
					<a href="{{route('api_create')}}">
						<button class="btn btn-info">{{__('api.manage.btn_create_api')}}</button>
					</a>
				</div>
			</div>
			<div class="col-md-12 pull-right">
				<table class="table" border=1>
					<thead>
						<tr>
							<th>
								{{__('api.manage.table.heading.url')}}
							</th>
							<th>
								{{__('api.manage.table.heading.ip')}}
							</th>
							<th>
								{{__('api.manage.table.heading.key')}}
							</th>
							<th>
								{{__('api.manage.table.heading.secret')}}
							</th>
							<th>
								{{__('api.manage.table.heading.enabled')}}
							</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@if(count($api)==0)
							<tr>
								<td colspan=2>
									{{__('api.manage.table.no_api')}}
								</td>
							</tr>
						@else
							@foreach($api as $r)
								<tr>
									<td>
										{{$r->url}} 
									</td>
									<td>
										{{$r->ip_address}}
									</td>
									<td>
										{{$r->key}}
									</td>
									<td>
										{{$r->secret}}
									</td>
									<td>
										{{$r->enabled}}
									</td>
									<td>
										<form method="POST" action="{{ route('api_en_dis') }}">
											{{csrf_field()}}
											<input type="hidden" name="id_api" value="{{$r->id}}">
											@if($r->enabled)
												<input type="submit" name="submit" class="btn btn-danger" value="Disable">
												<input type="hidden" name="status" value=0>
											@else
												<input type="submit" name="submit" class="btn btn-success" value="Enable">
												<input type="hidden" name="status" value=1>
											@endif
										</form>
									</td>
								</tr>
							@endforeach
						@endif
					</tbody>
				</table>	
			</div>
		</div>
	</div>
@endsection