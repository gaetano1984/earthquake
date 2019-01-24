@extends('layout')

@section('body')
	<div class="container" style="margin-top: 80px">
		<form method="POST" action="{{url('update_profile')}}">
			{{ csrf_field() }}
			<div class="form-group">
				<div class="col-md-4">
					<label class="form-label">
						Nome
					</label>
				</div>
				<div class="col-md-8">
					<input class="form-control" name="name" value="{{$user['name']}}">
					@if($errors->has('name'))
						<span class="validation-error">{{$errors->first('name')}}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label class="form-label">
						Cognome
					</label>
				</div>
				<div class="col-md-8">
					<input class="form-control" name="surname" value="{{$user['surname']}}">
					@if($errors->has('surname'))
						<span class="validation-error">{{$errors->first('surname')}}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label class="form-label">
						Email
					</label>
				</div>
				<div class="col-md-8">
					<input class="form-control" name="email" value="{{$user['email']}}">
					@if($errors->has('email'))
						<span class="validation-error">{{$errors->first('email')}}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label class="form-label">
						Magnitudo minima
					</label>
				</div>
				<div class="col-md-8">
					<input type="checkbox" id="id_enable_notify" name="enable_notify" value=1 @if($user['enable_notify']) checked @endif>
					<label for="id_enable_notify">da abilitare per ricevere una notifica mail quando avviene un terremoto nelle tue vicinanza</label>
					@if($errors->has('id_enable_notify'))
						<span class="validation-error">{{$errors->first('id_enable_notify')}}</span>
					@endif
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-4">
					<label class="form-label">
						Magnitudo minima
					</label>
				</div>
				<div class="col-md-8">
					<select name="magnitudo" class="form-control">
						@for($i=0; $i<=10; $i++)
							<option value="{{$i}}">{{$i}}</option>
						@endfor	
					</select>
					@if($errors->has('magnitudo'))
						<span class="validation-error">{{$errors->first('magnitudo')}}</span>
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

@section('extrascripts')
	@if(isset($message))
		alert('{{$message}}')
	@endif
@endsection