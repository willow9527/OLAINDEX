<?php

namespace App\Console\Commands\OneDrive;

use App\Helpers\OneDrive;
use Illuminate\Console\Command;

class Direct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'od:direct {remote : RemotePath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Direct Share Link';

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
     * @throws \ErrorException
     */
    public function handle()
    {
        $this->call('od:refresh');
        $this->info('Please waiting...');
        $remote = $this->argument('remote');
        $_remote
            = OneDrive::pathToItemId($remote);
        $remote_id = $_remote['errno'] === 200 ? array_get($_remote, 'data.id')
            : exit('Remote Path Abnormal');
        $response = OneDrive::createShareLink($remote_id);
        $response['errno'] === 0
            ? $this->info("Success! Direct Link:\n{$response['data']['redirect']}")
            : $this->warn("Failed!\n{$response['msg']} ");
    }
}
