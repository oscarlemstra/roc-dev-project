<?php

class DatabaseManager {
    private $host = "localhost";
    private $dbname = "roc_dev";
    private $port = "3306";
    private $user = "root";
    private $pass = "";


    //functions for connecting to database
    private function databaseHandle () {
        $dbh = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.';port='.$this->port, $this->user, $this->pass);
        return $dbh;
    }

    public function checkConnectionToDatabase ($debug = false) {
        try {
            $this->databaseHandle();
        } catch (PDOException $e) {
            if (!$debug) {
                print "something went wrong!" . "<br/>";
            }
            else {
                print "Error!: " . $e->getMessage() . "<br/>";
            }
            die();
        }
    }


    //get functions
    public function getAllRecordsFromTable ($tableName) {
        $query = "SELECT * FROM `$tableName`";
        $records = array();

        foreach ($this->databaseHandle()->query($query) as $row) {
            $records[] = $row;
        }
        return $records;
    }

    
    public function getRecordsFromTable ($tableName, $columnName, $columnValue) {
        $query = "SELECT * FROM `$tableName` WHERE `$columnName` = '$columnValue'";
        $records = array();

        foreach ($this->databaseHandle()->query($query) as $row) {
            $records[] = $row;
        }
        return $records;
    }


    //update function
    public function updateRecordsFromTable ($tableName, $columnName, $newColumnValue, $searchColumn, $searchColumnValue) {
        $query = "UPDATE `$tableName` SET `$columnName` = '$newColumnValue' WHERE `$searchColumn` = '$searchColumnValue'";

        $this->databaseHandle()->query($query);
    }


    //delete function
    public function deleteRecordsFromTable ($tableName, $columnName, $columnValue) {
        $query = "DELETE FROM `$tableName` WHERE `$columnName` = '$columnValue'";

        $this->databaseHandle()->query($query);
    }


    //insert function
    //
    //$tableName needs a string
    //
    //$values needs an associative array
    //
    public function insertRecordToTable ($tableName, $values) {
        $arrayLength = count($values);
        $counter = 1;
        $columnNames = "";
        $columnValues = "";

        foreach ($values as $key => $value) {
            if ($counter !== $arrayLength) {
                $columnNames .= "`" . $key . "`, ";
                $columnValues .= "'" . $value . "', ";
            }
            else {
                $columnNames .= "`" . $key . "`";
                $columnValues .= "'" . $value . "'";
            }

            $counter++;
        }


        $sql = "INSERT INTO `$tableName` ($columnNames) VALUES ($columnValues)";
        $query = $this->databaseHandle()->prepare($sql);

        try {
            $query->execute();
        }
        catch (PDOException $e) {
            print "ERROR!: " . $e->getMessage() . "</br>";
        }
    }
}
