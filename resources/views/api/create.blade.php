@extends('layout')

@section('body')
	

	<div class="container" style="margin-top: 80px;">
		<form method="POST" action="{{route('api_store')}}">
			{{ csrf_field() }}
			<div class="row">
				<div class="col-md-12">
					&nbsp;
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-2 text-right">
					<label class="form-label">
						Url
					</label>
				</div>
				<div class="col-md-4">
					<input class="form-control" name="url" value="{{ old('url')}}">
					@if($errors->has('url'))
						<span class="validation-error">{{$errors->first('url')}}</span>
					@endif
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-2 text-right">
					<label class="form-label">
						IP
					</label>
				</div>
				<div class="col-md-4">
					<input class="form-control" name="ip" value="{{ old('ip')}}">
					@if($errors->has('ip'))
						<span class="validation-error">{{$errors->first('ip')}}</span>
					@endif
				</div>
			</div>	

			<div class="form-group row">
				<div class="col-md-2 text-right">
					<label class="form-label">
						Key
					</label>
				</div>
				<div class="col-md-4">
					<input class="form-control" name="key" value="{{$key}}">
					@if($errors->has('key'))
						<span class="validation-error">{{$errors->first('key')}}</span>
					@endif
				</div>
			</div>	
			<div class="form-group row">
				<div class="col-md-2 text-right">
					<label class="form-label">
						Secret
					</label>
				</div>
				<div class="col-md-4">
					<input class="form-control" name="secret" value="{{$secret}}">
					@if($errors->has('secret'))
						<span class="validation-error">{{$errors->first('secret')}}</span>
					@endif
				</div>
			</div>	
			<div class="form-group row">
				<div class="col-md-2 text-right">
					<label class="form-label">
						Enabled
					</label>
				</div>
				<div class="col-md-4">
					<select class="form-control" name="enabled">
						<option value=1>Enabled</option>
						<option value=0>Disabled</option>
					</select>
					@if($errors->has('enabled'))
						<span class="validation-error">{{$errors->first('enabled')}}</span>
					@endif
				</div>
			</div>	
			<div class="form-group">
				<div class="col-md-6 text-right">
					<button class="btn btn-info">Salva</button>
				</div>
			</div>			
		</form>
	</div>
@endsection