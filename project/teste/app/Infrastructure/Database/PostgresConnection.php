<?php

namespace App\Infrastructure\Database;

class PostgresConnection implements DatabaseConnectionInterface {
    private static $instance = null;
    private $connection;
    private $host;
    private $dbname;
    private $user;
    private $password;

    private function __construct($host, $dbname, $user, $password) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
        $this->connection = pg_connect("host=$host dbname=$dbname user=$user password=$password");
    }

    public static function getInstance($host = '', $dbname = '', $user = '', $password = '') {
        if (self::$instance === null) {
            self::$instance = new PostgresConnection($host, $dbname, $user, $password);
        }

        return self::$instance;
    }

    public function connect() {
        return $this->connection;
    }

    public function disconnect() {
        pg_close($this->connection);
    }

    public function query(string $sql) {
        return pg_query($this->connection, $sql);
    }
}
?>