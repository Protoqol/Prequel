<?php

namespace Protoqol\Prequel\App;

use Illuminate\Database\Connection;
use Protoqol\Prequel\Connection\DatabaseConnector;
use Protoqol\Prequel\Database\DatabaseTraverser;

/**
 * Class AppStatus
 *
 * @package Protoqol\Prequel\App
 */
class AppStatus
{
    /**
     * Holds Prequel's database connection.
     *
     * @var Connection
     */
    private $connection;

    /**
     * Holds database traverser instance.
     *
     * @var DatabaseTraverser $traverser
     */
    private $traverser;

    /**
     * AppStatus constructor.
     */
    public function __construct()
    {
        $this->traverser = new DatabaseTraverser();
        $this->connection = (new DatabaseConnector())->getConnection();
    }

    /**
     * @return array
     */
    public function getStatus(): array
    {
        return [
            "migrations"  => (new MigrationAction("", ""))->pending(),
            "serverInfo"  => $this->serverInfo(),
            "permissions" => $this->userPermissions(),
        ];
    }

    /**
     * Get server info.
     *
     * @return array
     */
    private function serverInfo(): array
    {
        return $this->connection->getServerInfo();
    }

    /**
     * Check database permissions for current user.
     *
     * @return array
     */
    public function userPermissions(): array
    {
        $grants = $this->connection->getGrants();
        $privs = (string)array_values($grants)[0];
        $permissions = [];

        // If anyone seeing this has a better way of checking this, be my guest!
        $permissions["SELECT"] = false !== strpos($privs, "SELECT");
        $permissions["INSERT"] = false !== strpos($privs, "INSERT");
        $permissions["UPDATE"] = false !== strpos($privs, "UPDATE");
        $permissions["DELETE"] = false !== strpos($privs, "DELETE");
        $permissions["FILE"] = false !== strpos($privs, "FILE");
        $permissions["CREATE"] = false !== strpos($privs, "CREATE");
        $permissions["DROP"] = false !== strpos($privs, "DROP");
        $permissions["ALTER"] = false !== strpos($privs, "ALTER");
        $permissions["HAS_ALL"] = true;

        // Check if user has all needed permissions
        foreach ($permissions as $key => $val) {
            if ($val === false) {
                $permissions["HAS_ALL"] = false;
            }
        }

        return $permissions;
    }
}
