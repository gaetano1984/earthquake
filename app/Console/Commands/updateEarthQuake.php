<?php

namespace App\Console\Commands;

use App\Services\quakeService;
use Illuminate\Console\Command;
use App\Services\locationService;
use Symfony\Component\Console\Helper\ProgressBar;


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
    public function handle(quakeService $quakeService, locationService $locationService)
    {
        //
        $header = ['Data', 'Luogo', 'magnitudo', 'latitudine', 'longitudine'];   
        $this->info('inizio a recuperare la lista dei terremoti');
        $list = $quakeService->retrieveQuakeList();
        $this->info('lista recuperata');

        $to_save = $quakeService->getQuakeToSave($list);
        if(count($to_save)==0){
            $this->error("non ci sono nuovi eventi da salvare");
            return;
        }        

        $this->info('controllo se devo salvare qualche location');
        $location_to_save = $locationService->checkLocation($to_save);
        if(count($location_to_save)>0){
            $this->info("devo creare i seguenti ".count($location_to_save)." luoghi");
            
            $bar = $this->output->createProgressBar(count($location_to_save));
            $bar->start();

            $bar->setRedrawFrequency(50);
            foreach ($location_to_save as $key => $location) {
                $locationService->create($location);
                $bar->advance();
            }
            $bar->finish();
            $this->info("\nluoghi salvati");    
        }   

        $this->info("devo salvare ".count($to_save)." eventi");

        $table = [];
        if(count($to_save)>0){
            $this->info('salvo i terremoti trovati');

            $bar = $this->output->createProgressBar(count($to_save));
            $bar->start();

            $bar->setRedrawFrequency(50);

            foreach ($to_save as $key => $quake) {
                array_push($table, $quakeService->saveQuake($quake));
                $bar->advance();
            }
            $bar->finish();
        }
        $this->info("\n");
        if(count($table)>0){
            $this->table($header, $table);    
        }        
        $this->info("\nprocedura terminata");
    }    
}
