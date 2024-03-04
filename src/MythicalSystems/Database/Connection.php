<?php
namespace MythicalSystems\Database;

use mysqli;
use Exception;
use SQLite3;

class Connection
{
    private static $remote_Connection;
    private static $local_Connection;
    /**
     * Get a remote connection to a MySQL server!
     * 
     * @param string $host The database host
     * @param int|null $port The database port
     * @param string $username The database username
     * @param string|null $password The database password
     * @param string $table The databases table!
     * 
     * @return mysqli A MySQL connection
     * 
     * @throws Exception 
     */
    public static function getRemoteConnection(string $host, int $port, string $username, string|null $password, string $table): mysqli
    {
        if (!isset(self::$remote_Connection)) {
            self::$remote_Connection = new mysqli(
                $host,
                $username,
                $password,
                $table,
                $port
            );

            if (self::$remote_Connection->connect_error) {
                throw new Exception("[MythicalSystems] Failed to connect to the MySQL/MariaDB server:" . self::$remote_Connection->connect_error);
            }
        }
        return self::$remote_Connection;
    }
    /**
     * Connect to a local database
     * 
     * @param string $file The file path
     * 
     * @return SQLite3 The connection
     * @throws Exception
     */
    public static function getLocalConnection(string $file): SQLite3
    {
        if (file_exists($file)) {
            if (extension_loaded('sqlite3')) {
                if (!isset(self::$local_Connection)) {
                    self::$local_Connection = new SQLite3($file);
                    if (!self::$local_Connection) {

                    }
                }

                return self::$local_Connection;
            } else {
                throw new Exception("It looks like you did not install the sqlite3 extension for php!");
            }
        } else {
            throw new Exception("No valid file path was provided or file does not exist");
        }

    }

    /**
     * Close a database connection if open
     * 
     * @return void
     */
    public static function closeConnection(): void
    {
        if (isset(self::$remote_Connection)) {
            self::$remote_Connection->close();
            self::$remote_Connection = null;
        }

        if (isset(self::$local_Connection)) {
            self::$local_Connection->close();
            self::$local_Connection = null;
        }
    }
}
?>