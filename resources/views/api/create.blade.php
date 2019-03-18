@extends('layout')

@section('body')
	<div class="container" style="margin-top: 80px;">
		<form method="POST" action="{{url('api_store')}}">
			<div class="row">
				<div class="col-md-12">
					creazione API		
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label class="form-label">
						Url
					</label>
				</div>
				<div class="col-md-8">
					<input class="form-control" name="url" value="{{$user['url']}}">
					@if($errors->has('url'))
						<span class="validation-error">{{$errors->first('url')}}</span>
					@endif
				</div>
			</div>	
			<div class="form-group">
				<div class="col-md-4">
					<label class="form-label">
						Key
					</label>
				</div>
				<div class="col-md-8">
					<input class="form-control" name="key" value="{{$user['key']}}">
					@if($errors->has('key'))
						<span class="validation-error">{{$errors->first('key')}}</span>
					@endif
				</div>
			</div>	
			<div class="form-group">
				<div class="col-md-4">
					<label class="form-label">
						Secret
					</label>
				</div>
				<div class="col-md-8">
					<input class="form-control" name="secret" value="{{$user['secret']}}">
					@if($errors->has('secret'))
						<span class="validation-error">{{$errors->first('secret')}}</span>
					@endif
				</div>
			</div>	
			<div class="form-group">
				<div class="col-md-4">
					<label class="form-label">
						Enabled
					</label>
				</div>
				<div class="col-md-8">
					<select class="form-control" name="enlabled">
						<option>Enabled</option>
						<option>Disabled</option>
					</select>
					@if($errors->has('enabled'))
						<span class="validation-error">{{$errors->first('enabled')}}</span>
					@endif
				</div>
			</div>	
			<div class="form-group">
				<div class="col-md-12">
					<button class="btn btn-info">Salva</button>
				</div>
			</div>			
		</form>
	</div>
@endsection