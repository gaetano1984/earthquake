<?php 

	return [	
		'earthquake' => 'Terremoti',
		'menu' => [
			'most_recent' => 'Pi&ugrave; recenti'
			,'stats' => 'Statistiche'
		],	
		'list' => [
			'header' => [
				'quake_id' => 'ID Terremoto'
				,'location' => 'Luogo'
				,'creationTime' => 'Data Evento'
				,'magnitude' => 'Magnitudo'
			]
		],
		'validation' => [
			'min' => [
				'required' => 'Il campo magnitudo minima è obbligatorio'
				,'numeric' => 'Il campo magnitudo minima deve essere numerico'
			]
			,'max' => [
				'required' => 'Il campo magnitudo massima è obbligatorio'
				,'numeric' => 'Il campo magnitudo massima deve essere numerico'
			]
		],
		'filters' => [
			'min_magnitude' => 'Magnitudo Minima'
			,'max_magnitude' => 'Magnitudo Massima'
			,'start_date' => 'Data Inizio'
			,'end_date' => 'Data Fine'
		]
	];

 ?>