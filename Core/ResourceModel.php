<?php

namespace MVC\Core;

use MVC\Core\ResourceModelInterface;
use MVC\Models\TaskModel;
use MVC\Config\Database;
use PDO;

class ResourceModel implements ResourceModelInterface
{
    private $table;
    private $id;
    private $model;

    public function _init($table, $id, $model)
    {
        $this->table = $table;
        $this->id = $id;
        $this->model = $model;
    }

    public function save($model) {
        $arrayValue = $model->getProperties();
        $add_attributes = array();
        $update_attributes = array();
        $addValue = array();

        if ($model->getId() == null) {

            foreach ($arrayValue as $value => $index) {
                if($value == null)  continue;
                $add_attributes[] = $value;
                array_push($addValue, ':' . $value);
            }

            $str_attribute = implode(', ', $add_attributes);
            $str_value = implode(', ', $addValue);
            $sql = "INSERT INTO $this->table";
            $sql .= " (".$str_attribute.")";
            $sql .= " VALUES(" . $str_value . ")";

            $result = Database::getBdd()->prepare($sql);

            return $result->execute($arrayValue);
        } else {
            $id = $model->getId();

            foreach ($arrayValue as $value => $index) {
                if ($value == null)   continue;
                array_push($update_attributes, $value . " = :" . $value);
            }

            $str_attribute = implode(', ', $update_attributes);

            $sql = "UPDATE $this->table SET " . $str_attribute;
            $sql .= " WHERE id = " . $id;

            $result = Database::getBdd()->prepare($sql);
            return $result->execute($arrayValue);
        }
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->table";
        $sql .= " WHERE id = ?";
        $result = Database::getBdd()->prepare($sql);
        return $result->execute([$id]);
    }

    public function getList()
    {
        $sql = "SELECT * FROM $this->table";
        $result = Database::getBdd()->prepare($sql);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);
    }

    public function getModelById($id)
    {
        $sql = "SELECT * FROM $this->table";
        $sql .= " WHERE id = ?";
        $result = Database::getBdd()->prepare($sql);
        $result->execute([$id]);
        return $result->fetch();
    }
}                                                               