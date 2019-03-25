<?php 

      return [    
            'validation' => [
                  'url' => [
                        'required_without' => 'La url è obbligatoria se non viene specificato l\'indirizzo IP'
                        ,'url' => 'La url deve essere nel formato url'
                        ,'unique' => 'Questa url è già stata registrata'
                  ]
                  ,'ip' => [
                        'required_without' => 'L\'indirozzo ip è obbligatorio se non viene specificato una url'
                        ,'ip' => 'L\'indirizzo ip deve essere nel formato ip'
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