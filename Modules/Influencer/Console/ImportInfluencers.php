<?php

namespace Modules\Influencer\Console;

use Illuminate\Console\Command;
use App\Imports\InfluencersImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportInfluencers extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'import:influencers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import influencers';

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
    public function handle()
    {
        //
        // Excel::import(new InfluencersImport);
        
        (new InfluencersImport)->import(public_path("uploads/influencers.xlsx"),null, \Maatwebsite\Excel\Excel::XLSX);


        // $collection = (new InfluencersImport)->toCollection(storage_path("app/data/influencers.xlsx"));

        // (new )->import(\), null, \Maatwebsite\Excel\Excel::XLSX);

        // dd($collection->get(0));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            
        ];
    }
}
