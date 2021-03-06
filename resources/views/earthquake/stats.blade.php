@extends('layout')

@section('extracss')
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
	{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/it.js"></script> --}}
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
@endsection

@section('body')
	<div class="container" style="margin-top: 80px; max-width: 1800px;">
		<div class="row">
			<div class="col-md-12">
				<form id="stats_form" class="form-inline" method="POST">
					@include('earthquake.filters.slider')
					@include('earthquake.filters.min_date')
					@include('earthquake.filters.max_date')	
					@include('earthquake.filters.location')
				</div>
			</div>
			<div class="row">
				&nbsp;
			</div>
			<div class="row">
				<div class="col-md-12">
					@include('earthquake.filters.search')
					@include('earthquake.filters.export')
				    {{ csrf_field() }}
				</form>
			</div>
		</div>
		<div class="row">
			&nbsp;
		</div>
		<div class="row">
			<div class="col-md-6">
				<canvas id="canvas"></canvas>
			</div>
			<div class="col-md-6">
				<canvas id="canvas_b"></canvas>
			</div>
		</div>
	</div>
@endsection

@section('extrascripts')
	<script type="text/javascript" src="https://www.chartjs.org/dist/2.7.3/Chart.bundle.js"></script>
	<script type="text/javascript" src="https://www.chartjs.org/samples/latest/utils.js"></script>
	<script type="text/javascript">
		$('#export').on('click', function(){
			$('#stats_form').attr('action', "{{route('quake_excel_export')}}");
			$('#stats_form').submit();
		});
		$('#search').on('click', function(){
			$('#stats_form').attr('action', "{{route('quake_stats_post')}}");
			$('#stats_form').submit();
		});
		$('#location').select2({
			allowClear: true
			,placeholder: {
				id: '-1'
				,text: "seleziona luogo"
				,selected: "selected"
			}
			,data:[
				{id: -1,text: '',selected: 'selected',search:'',hidden:true},
			]
		});

		@if(isset($location_id))
			$('#location').val('{{$location_id}}').trigger('change');
		@endif

		var config = {
			type: 'line',
			data: {
				labels: {!! json_encode($arr_date) !!}
				,datasets: [{
					label: 'Tot Terremoti',
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: {{ json_encode($arr_count) }},		
					fill: false
				}]
			}
			,options:{
				scales:{
					yAxes: [{
						ticks:{
							min: 0
						}
					}]
				}
			},
		};
		var config_b = {
			type: 'bar',
			data: {
				labels: {!! json_encode($arr_magnitude) !!}
				,datasets: [{
					label: 'Magnitudo',
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: {{ json_encode($arr_count_b) }},					
					fill: false
				}]
			}
			,options:{
				scales:{
					yAxes: [{
						ticks:{
							min: 0
						}
					}]
				}
			},
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
			var ctx_b = document.getElementById('canvas_b').getContext('2d');
			window.myLine = new Chart(ctx_b, config_b);
		};

		$('#min_date').datepicker({
			dateFormat: 'yy-mm-dd'
		});
		$('#max_date').datepicker({
			dateFormat: 'yy-mm-dd'
		});

		$('#slider').slider({
			range: true
			,min: 1
			,max: 10
			,step: 1
			,values: [{{$mag_min}},{{$mag_max}}]
			,change: function(e, u){
				min = u.values[0];
				max = u.values[1];
				$('#magn_min').text(min);
				$('#magn_max').text(max);
				$('#magnitudo_minima').val(min);
				$('#magnitudo_massima').val(max);
			}
		});

	</script>
@endsection