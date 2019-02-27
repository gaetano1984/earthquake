<div class="col-md-3">
	<div class="form-group">
		<label class="label-control col-md-4">
			Luogo
		</label>
		<select class="form-control col-md-8" id="location" name="location">
			@foreach($location as $id=>$l)
				<option value={{$id}}>{{$l}}</option>
			@endforeach
		</select>	
	</div>
</div>