<?php

declare(strict_types = 1);

namespace Protoqol\Prequel\Tests\Unit\Classes\Database;

use Protoqol\Prequel\Classes\Database\SequelAdapter;
use Protoqol\Prequel\Tests\TestCase;

/**
 * Class SequelAdapterTest
 * @package Protoqol\Prequel\Tests\Unit\Classes\Database
 */
class SequelAdapterTest extends TestCase
{

    /**
     * @dataProvider showDatabasesDataProvider
     *
     * @param string $databaseType
     * @param string $expected
     */
    public function testShowDatabasesGetsProperCommand(string $databaseType, string $expected): void
    {
        // force config
        config([ "database.connections.{$databaseType}.driver" => $databaseType ]);

        $adapter = new SequelAdapter($databaseType);
        $this->assertEquals($expected, $adapter->showDatabases());
    }

    /**
     * Should add in more when more DB's are supported
     * @return array
     */
    public function showDatabasesDataProvider(): array
    {
        return [
            [ 'mysql', 'SHOW DATABASES;' ],
            [ 'pgsql', 'SELECT datname FROM pg_database WHERE datistemplate = false;' ],
        ];
    }

    public function testShowDatabasesThrowsExceptionForUnsupported(): void
    {
        //$this->expectException(\Exception::class);
        $this->expectExceptionMessage('Selected invalid or unsupported database driver');

        // force config
        config([ "database.connections.my-test-here.driver" => 'unsupported-driver' ]);

        $adapter = new SequelAdapter('my-test-here');
        $adapter->showDatabases();
    }
}
