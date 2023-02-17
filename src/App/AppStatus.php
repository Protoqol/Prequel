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
     * AppStatus constructor.
     */
    public function __construct()
    {
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
        $grants      = $this->connection->getGrants();
        $privs       = (string) array_values($grants)[0];
        $permissions = [];

        // If anyone seeing this has a better way of checking this, be my guest!
        $permissions["SELECT"]  = strpos($privs, "SELECT") !== false;
        $permissions["INSERT"]  = strpos($privs, "INSERT") !== false;
        $permissions["UPDATE"]  = strpos($privs, "UPDATE") !== false;
        $permissions["DELETE"]  = strpos($privs, "DELETE") !== false;
        $permissions["FILE"]    = strpos($privs, "FILE") !== false;
        $permissions["CREATE"]  = strpos($privs, "CREATE") !== false;
        $permissions["DROP"]    = strpos($privs, "DROP") !== false;
        $permissions["ALTER"]   = strpos($privs, "ALTER") !== false;
        $permissions["HAS_ALL"] = true;

        // Check if user has all needed permissions
        foreach ($permissions as $val) {
            if ($val === false) {
                $permissions["HAS_ALL"] = false;
            }
        }

        return $permissions;
    }
}
