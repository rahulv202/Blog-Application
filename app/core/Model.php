<?php

namespace App\Core;

use PDO;

class Model
{
    protected $table;

    // use When login by email and single post by id
    public function find($key, $value)
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM {$this->table} WHERE $key = :value";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':value', $value);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save($key = array(), $value = array())
    {
        $db = Database::getInstance();
        $key = implode(',', $key);
        $value = $value = "'" . implode("','", $value) . "'";
        $query = "INSERT INTO {$this->table} ($key) VALUES ($value)";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $db->lastInsertId();
    }

    public function update($key = array(), $id)
    {
        $db = Database::getInstance();
        // $key = implode(',', $key);
        // print_r($key);
        $key_new = "";
        foreach ($key as $k => $v) {
            // $key_new .= " '" . $k . "'" . " = '" . $v . "',";
            $key_new .= $k . " = '" . $v . "',";
        }
        $key_new = rtrim($key_new, ",");
        // print_r($key_new);
        // exit();
        $query = "UPDATE {$this->table} SET $key_new  WHERE id = $id";
        //echo $query . "\n";
        $stmt = $db->prepare($query);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $db = Database::getInstance();
        $query = "DELETE FROM {$this->table} WHERE id = {$id}";
        // echo $query . "<br>";
        // exit();
        $stmt = $db->prepare($query);
        return $stmt->execute();
        // return $stmt->rowCount();
    }

    public function getAllData()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM {$this->table}";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDataColumnName($key = array())
    {
        $db = Database::getInstance();
        $key = implode(',', $key);
        $query = "SELECT $key FROM {$this->table}";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
