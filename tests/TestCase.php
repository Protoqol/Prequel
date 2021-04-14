<?php
    /**
     * This abstract test case holds all of our configurations that are necessary for this project
     */
    declare(strict_types=1);
    
    namespace Protoqol\Prequel\Tests;
    
    use Orchestra\Testbench\TestCase as OrchestraTestCase;
    use Protoqol\Prequel\PrequelServiceProvider;
    
    /**
     * Class TestCase
     *
     * @package Protoqol\Prequel\Tests
     */
    abstract class TestCase extends OrchestraTestCase
    {
        /**
         * Load the service providers for this application
         *
         * @param  \Illuminate\Foundation\Application  $app
         *
         * @return array
         */
        protected function getPackageProviders($app) : array {
            return [PrequelServiceProvider::class];
        }
    }
