<?php


namespace Protoqol\Prequel\Classes\App;

use Protoqol\Prequel\Classes\Database\DatabaseConnector;
use Protoqol\Prequel\Classes\Database\DatabaseTraverser;

/**
 * Class AppStatus
 * @package Protoqol\Prequel\Classes\App
 */
class AppStatus
{

    /**
     * Holds Prequel's database connection.
     * @var \Illuminate\Database\Connection
     */
    private $connection;

    /**
     * Holds database traverser instance.
     * @var \Protoqol\Prequel\Classes\Database\DatabaseTraverser $traverser
     */
    private $traverser;

    /**
     * AppStatus constructor.
     */
    public function __construct()
    {
        $this->traverser  = new DatabaseTraverser();
        $this->connection = (new DatabaseConnector())->getConnection();
    }

    /**
     * @return array
     */
    public function getStatus(): array
    {
        return [
            'migrations'  => (new Migrations())->pending(),
            'serverInfo'  => $this->serverInfo(),
            'permissions' => $this->userPermissions(),
        ];
    }

    /**
     * Get server info.
     * @return array
     */
    private function serverInfo(): array
    {
        return $this->connection->getServerInfo();
    }

    /**
     * Check database permissions for current user.
     * @return array
     */
    public function userPermissions(): array
    {

        $grants      = $this->connection->getGrants();
        $privs       = (string)array_values($grants)[0];
        $permissions = [];

        // If anyone seeing this has a better way of checking this, be my guest!
        $permissions['SELECT']  = (bool)preg_match('(SELECT)', $privs);
        $permissions['INSERT']  = (bool)preg_match('(INSERT)', $privs);
        $permissions['UPDATE']  = (bool)preg_match('(UPDATE)', $privs);
        $permissions['DELETE']  = (bool)preg_match('(DELETE)', $privs);
        $permissions['FILE']    = (bool)preg_match('(FILE)', $privs);
        $permissions['CREATE']  = (bool)preg_match('(CREATE)', $privs);
        $permissions['DROP']    = (bool)preg_match('(DROP)', $privs);
        $permissions['ALTER']   = (bool)preg_match('(ALTER)', $privs);
        $permissions['HAS_ALL'] = true;

        // Check if user has all needed permissions
        foreach ($permissions as $key => $val) {
            if ($val === false) {
                $permissions['HAS_ALL'] = false;
            }
        }

        return $permissions;
    }
}
