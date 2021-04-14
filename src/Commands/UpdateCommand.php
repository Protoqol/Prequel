<?php

namespace Protoqol\Prequel\Commands;

use Illuminate\Console\Command;

/**
 * Class UpdateCommand
 *
 * @package Protoqol\Prequel\Commands
 */
class UpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "prequel:update";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Update Prequel assets, re-publishing them.";

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
     */
    public function handle()
    {
        $this->info("Updating Prequel Resources...");

        $this->comment("Updating Prequel Service Provider...");
        $this->callSilent("vendor:publish", [
            "--provider" => "Protoqol\Prequel\PrequelServiceProvider",
            "--force"    => true,
        ]);

        $this->comment("Updating Prequel Assets...");
        $this->callSilent("vendor:publish", [
            "--tag"   => "prequel-assets",
            "--force" => true,
        ]);

        $this->comment("Updating Prequel Config...");
        $this->callSilent("vendor:publish", [
            "--tag"   => "prequel-config",
            "--force" => true,
        ]);

        $this->comment("Updating Prequel Translations...");
        $this->callSilent("vendor:publish", [
            "--tag"   => "prequel-lang",
            "--force" => true,
        ]);

        $this->info("Prequel is up-to-date!");
    }
}
