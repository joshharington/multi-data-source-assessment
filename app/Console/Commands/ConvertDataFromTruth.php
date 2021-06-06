<?php

namespace App\Console\Commands;

use App\Utilities\DataStoreHelper;
use Illuminate\Console\Command;

class ConvertDataFromTruth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:convert-from {from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $source_from = $this->argument('from');
        $data = DataStoreHelper::getAllFromSource($source_from);

        switch(strtoupper($source_from)) {
            case "DB":
                // Convert to JSON
                $res = DataStoreHelper::overwriteDataSourceFromTruth($data, "JSON");
                echo 'Converted to JSON datastore: ' . (($res) ? 'Success' : 'Failed') . PHP_EOL;
                break;
            case "JSON":
                // Convert to DB
                $res = DataStoreHelper::overwriteDataSourceFromTruth($data, "DB");
                echo 'Converted to DB datastore: ' . (($res) ? 'Success' : 'Failed') . PHP_EOL;
                break;
            default:
                die;
        }

    }
}
