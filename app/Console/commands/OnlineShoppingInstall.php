<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class OnlineShoppingInstall extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'onlineshopping:install {--force : Do not ask for user confirmation}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Install dummy data for the Online Shopping Application';

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
    $this->proceed();
  }

  protected function proceed()
  {
    $this->info('Dummy data installed');
  }
}
