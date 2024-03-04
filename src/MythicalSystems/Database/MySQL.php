<?php 
namespace MythicalSystems\Database;

class MySQL extends Connection {

    /**
     * Execute a database query
     *
     * @param string $query The SQL query
     * @param array $params An array of parameters to bind to the query
     * @param bool $returnResult Whether to return the result set for select queries
     * 
     * MySQL Connection
     * 
     * @param string $host The database host
     * @param int|null $port The database port
     * @param string $username The database username
     * @param string|null $password The database password
     * @param string $table The databases table!
     *
     * @return mixed True if the query was successful (for non-select queries), mysqli_result for select queries, false on failure
     */
    private static function executeQuery(string $query, array $params = [], bool $returnResult = false, string $host, int $port, string $username, string|null $password, string $table) : mixed
    {
        $connection = self::getRemoteConnection($host,$port, $username, $password, $table);
        $stmt = mysqli_prepare($connection, $query);

        if (!empty($params)) {
            $paramTypes = str_repeat('s', count($params));
            mysqli_stmt_bind_param($stmt, $paramTypes, ...$params);
        }

        $result = $stmt->execute();

        if ($returnResult) {
            $resultSet = $stmt->get_result();
            $stmt->close();
            return $resultSet;
        }

        $stmt->close();

        // Close the connection after use
        self::closeConnection();
        return $result;
    }

    
}
?>