<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\quakeService;

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
    public function handle(quakeService $quakeService)
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
        $this->info("devo salvare ".count($to_save)." eventi");

        $this->info('salvo i terremoti trovati');

        $bar = $this->output->createProgressBar(count($to_save));
        $bar->start();

        $bar->setRedrawFrequency(50);

        $table = [];
        foreach ($to_save as $key => $quake) {
            array_push($table, $quakeService->saveQuake($quake));
            $bar->advance();
        }
        $bar->finish();
        
        //$this->table($header, $table);
        $this->info("\nprocedura terminata");
    }    
}
