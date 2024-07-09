<?php
namespace MythicalSystems\Database;

use SQLite3;

class SQLite extends Connection
{
    /**
     * Execute a database query
     *
     * @param string $query The SQL query
     * @param array $params An array of parameters to bind to the query
     * @param bool $returnResult Whether to return the result set for select queries
     *
     * SQLite3
     * @param string $file The filepath of the sqlite file!
     * 
     * @return mixed True if the query was successful (for non-select queries), SQLite3Result for select queries, false on failure
     */
    private static function executeQuery(string $query, array $params = [], bool $returnResult = false, string $file)
    {
        $connection = self::getLocalConnection($file);
        $stmt = $connection->prepare($query);

        if (!empty($params)) {
            foreach ($params as $param) {
                $i = 0;
                $stmt->bindValue('?' . ++$i, $param);
            }
        }

        $result = $stmt->execute();

        if ($returnResult) {
            return $result;
        }

        $stmt->close();

        // Close the connection after use
        self::closeConnection();

        return $result;
    }
}
?>