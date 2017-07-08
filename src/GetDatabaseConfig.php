<?php namespace BackupManager\Laravel;

use BackupManager\Config\Config;

/**
 * Class GetDatabaseConfig
 *
 * @package BackupManager\Laravel
 */
trait GetDatabaseConfig
{
    /**
     * @param $connections
     * @return Config
     */
    private function getDatabaseConfig($connections) {
        $mapped = array_map(function ($connection) {
            if ( ! in_array($connection['driver'], ['mysql', 'pgsql'])) {
                return;
            }

            $driver = array_column($connection, 'driver');
            $driver = empty($driver) ? $connection['driver'] : $driver[0];

            $host = array_column($connection, 'host');
            $host = empty($host) ? $connection['host'] : $host[0];

            $port = array_column($connection, 'port');
            $port = empty($port) ? $connection['port'] : $port[0];
            
            $username = array_column($connection, 'username');
            $username = empty($username) ? $connection['username'] : $username[0];

            $password = array_column($connection, 'password');
            $password = empty($password) ? $connection['password'] : $password[0];

            $database = array_column($connection, 'database');
            $database = empty($database) ? $connection['database'] : $database[0];


            return [
                'type'     => $driver,
                'host'     => $host,
                'port'     => $port,
                'user'     => $username,
                'pass'     => $password,
                'database' => $database,
            ];
        }, $connections);
        return new Config($mapped);
    }
}
