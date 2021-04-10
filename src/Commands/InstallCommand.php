<?php

namespace Protoqol\Prequel\Commands;

use Illuminate\Console\Command;

/**
 * Class InstallCommand
 *
 * @package App\Console\Commands
 */
class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "prequel:install";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Install Prequel, publishing its ServiceProvider, config and assets.";

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
    public function handle(): void
    {
        $this->comment("Publishing Prequel Service Provider...");
        $this->callSilent("vendor:publish", [
            "--provider" => "Protoqol\Prequel\PrequelServiceProvider",
        ]);

        $this->comment("Publishing Prequel Assets...");
        $this->callSilent("vendor:publish", [
            "--tag" => "prequel-assets",
        ]);

        $this->comment("Publishing Prequel Config...");
        $this->callSilent("vendor:publish", [
            "--tag" => "prequel-config",
        ]);

        $this->comment("Publishing Prequel Translations...");
        $this->callSilent("vendor:publish", [
            "--tag" => "prequel-lang",
        ]);

        $this->info("Prequel succesfully installed.");
    }
}
