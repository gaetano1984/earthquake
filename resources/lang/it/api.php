<?php 

	return [	
		'validation' => [
			'url' => [
                  	'required' => 'La url è obbligatoria'
                  	,'url' => 'La url deve essere nel formato url oppure un indirizzo IP'
                  ]
                  ,'key' => [
              		'required' => 'La key è obbligatoria'
                  	,'max' => 'La key deve essere lunga massimo 255 caratteri'
                  ]
                  ,'secret' => [
                  	'required' => 'La secret è obbligatoria'
                  	,'max' => 'La secret deve essere lunga massimo 255 caratteri'
                  ]
		],
	];

 ?>