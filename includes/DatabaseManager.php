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

    public function checkConnectionToDatabase () {
        try {
            $this->databaseHandle();
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }


    //get functions
    public function getAllRecordsFromTable ($tableName) {
        $query = "SELECT * FROM $tableName";
        $records = array();

        foreach ($this->databaseHandle()->query($query) as $row) {
            $records[] = $row;
        }
        return $records;
    }

    
    public function getRecordsFromTable ($tableName, $columnName, $columnValue) {
        $query = "SELECT * FROM $tableName WHERE $columnName = '$columnValue'";
        $records = array();

        foreach ($this->databaseHandle()->query($query) as $row) {
            $records[] = $row;
        }
        return $records;
    }


    //update function
    public function updateRecordsFromTable ($tableName, $columnName, $newColumnValue, $searchColumn, $searchColumnValue) {
        $query = "UPDATE $tableName SET $columnName = '$newColumnValue' WHERE $searchColumn = '$searchColumnValue'";

        $this->databaseHandle()->query($query);
    }


    //delete function
    public function deleteRecordsFromTable ($tableName, $columnName, $columnValue) {
        $query = "DELETE FROM $tableName WHERE $columnName = '$columnValue'";

        $this->databaseHandle()->query($query);
    }



    //insert functions
    //
    //insert user
    public function insertRecordToUser ($user_role_id, $email, $hashed_password) {
        $query = "INSERT INTO user (user_role_id, email, hashed_password)
                  VALUES ('$user_role_id', '$email', '$hashed_password')";

        $this->databaseHandle()->query($query);
    }
}