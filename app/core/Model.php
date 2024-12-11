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

    public function update($key = array(), $value = array(), $id)
    {
        $db = Database::getInstance();
        $query = "UPDATE {$this->table} SET $key = $value WHERE id = $id";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $db->lastInsertId();
    }

    public function delete($id)
    {
        $db = Database::getInstance();
        $query = "DELETE FROM {$this->table} WHERE id = $id";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
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
