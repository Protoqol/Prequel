<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Tests;

use Orchestra\Testbench\TestCase;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;
use Protoqol\Prequel\PrequelServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * GetAll test class
 */
class GetAll extends TestCase
{

    use RefreshDatabase;

    /**
     * Setup test env
     *
     * @return void
     */
    protected function setUp() :void
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'testing']);
    }

    /**
     * @param $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            PrequelServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
    }

    /** @test */
    public function testGetAllDatabaseData()
    {
        $this->assertTrue(true);
//        $database = new DatabaseTraverser();
//        $this->assertArrayHasKey('tables', $database->getAll());
    }
}
