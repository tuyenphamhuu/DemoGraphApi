<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Auth\AuthController;

class Auto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $auto;
    protected $signature = 'auto {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'auto load AuthController';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AuthController $auto)
    {
        parent::__construct();
        $this->auto = $auto;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $result = $this->auto;
        return $this->auto->like($this->argument('id'));
    }
}
