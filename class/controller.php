<?php

class Controller
{

    protected static $connection;

    public function connect()
    {

        if (!isset(self::$connection)) {
            self::$connection = new mysqli('localhost', 'root', 'root', 'zentoplan');
        }

        if (self::$connection === false) {
            return false;
        }
        return self::$connection;
    }


    public function query($query)
    {
        // Connect to the database
        $connection = $this->connect();
        // Query the database
        $result = $connection->query($query);
        return $result;
    }


    public function selectquery($query)
    {

        $rows = array();
        $result = $this->query($query);
        if ($result === false) {
            return false;
        }
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function quote($value)
    {
        $connection = $this->connect();
        return "'" . $connection->real_escape_string($value) . "'";
    }

}

?>