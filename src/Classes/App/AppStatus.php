<?php


namespace Protoqol\Prequel\Classes\App;

use FilesystemIterator;
use Illuminate\Database\Console\Migrations\MigrateCommand;
use Illuminate\Database\Migrations\Migration;
use PDO;
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

    public function __construct()
    {
        $this->traverser  = new DatabaseTraverser();
        $this->connection = (new DatabaseConnector())->getConnection();
    }

    /**
     * Get general status.
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
        if($this->connection->getPdo()->getAttribute(PDO::ATTR_DRIVER_NAME) === 'pgsql') {
            $query = 'select extract(epoch from current_timestamp - pg_postmaster_start_time())';
            $serverInfoArray    = [
                'UPTIME'    => intval($this->connection->getPdo()->query($query)->fetch()[0])
            ];
        } else {
            $serverInfo         = $this->connection->getPdo()->getAttribute(PDO::ATTR_SERVER_INFO);

            $explodedServerInfo = explode('  ', $serverInfo);
            $serverInfoArray    = [];

            foreach ($explodedServerInfo as $attr) {
                $split                 = explode(': ', $attr);
                $key                   = strtoupper(str_replace(' ', '_', str_replace(':', '', $split[0])));
                $serverInfoArray[$key] = $split[1];
            }
        }

        return $serverInfoArray;
    }

    /**
     * Check database permissions for current user.
     * @return array
     */
    public function userPermissions(): array
    {
        //PostgreSQL
        if(config('prequel.database.connection') === 'pgsql') {
            $grants      = (array)$this->connection->select('SELECT grantee, privilege_type FROM information_schema.role_table_grants;')[0];
        } else {
            $grants      = (array)$this->connection->select('SHOW GRANTS FOR CURRENT_USER();')[0];
        }
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
