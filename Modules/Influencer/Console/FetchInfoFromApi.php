<?php

namespace Modules\Influencer\Console;

use Illuminate\Console\Command;
use Modules\Influencer\Entities\Instagram;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class FetchInfoFromApi extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'influencer:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get account statistic for influence account';

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
        $type = $this->argument('type');
        $num  = (int)$this->option("num");

        if (!method_exists($this, $type)) {
            $this->error("type not allowed");
            return ;
        }

        $this->$type($num);
        // dd($type, $num);
    }

    private function instagram($num)
    {
        $error = [];
        $loop = $num;

        $bar = $this->output->createProgressBar($num);
        $bar->start();

        while ($loop > 0) {
            $account = Instagram::whereNull("latest_calling_at")->whereNotIn("id", $error)->first();
            try {
                \Modules\Core\Packages\Influencer\InfluencerStatistic::instagram()
                ->setModel($account)
                ->fetchDataApi()
                ->updateModel()
                ->saveData()
                ->end()
                ;
            } catch(\Exception $e) {
                $this->error("id={$account->id} , " . $e->getMessage());
                array_push($error, $account->id);
            }
            $bar->advance();

            $loop --;
        }
        $bar->finish();


        $errorCount = count($error);
        $this->info(sprintf("done( %s ) ... , without(%s)=".json_encode($error), $num - $errorCount, $errorCount));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['type', InputArgument::OPTIONAL, 'The type of account can be instagram | tiktok | youtube .', "instagram"],
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
            ['num', "N", InputOption::VALUE_OPTIONAL, 'Number of account will be fetch ', 200],
        ];
    }
}
