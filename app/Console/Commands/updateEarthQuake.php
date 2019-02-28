<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\quakeService;

class updateEarthQuake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'earthquake:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command read list of earthquake and update list';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(quakeService $quakeService)
    {
        //
        $header = ['Data', 'Luogo', 'magnitudo', 'latitudine', 'longitudine'];
        $quakes = $quakeService->update();
        if(count($quakes)>0){
            $this->table($header, $quakes);    
        }        
    }
}
