<?php

namespace App\Repositories;
use App\Database;
use App\Logger\Logger;
use App\Models\Consulta;

class ApiRepository implements IRepository 
{
    public $database;

    public function __construct($database) 
    {
        if(!$this->database) {
            $this->database = $database;
        }
    }
    
    public function FindAll()
    {
        $query = $this->database->mysql->query("select * FROM consultas");
        $listaConsultas = [];

            foreach ($query as $consulta) {
                $itemConsulta = new Consulta($consulta["id"], $consulta["name"],  $consulta["tema"], $consulta["fecha"]);
                array_push($listaConsultas, $itemConsulta);
            }
            
        Logger::log("get", "createList", $listaConsultas);
        return json_encode($listaConsultas);
    }

    public function findById($id)
    {
        $query = $this->database->mysql->query("SELECT * FROM `consultas` WHERE `id` = '{$id}'");
        
        $result = $query->fetchAll();
        $consulta = new Consulta($result[0]["id"], $result[0]["name"], $result[0]["tema"], $result[0]["fecha"]);
        Logger::log("FindByID", "find", $consulta);
        return $consulta;
    }

    public function save($id, $request)
    {
       
        $this->database->mysql->query("INSERT INTO `consultas` (`id`, `name`, `tema`) VALUES ('{$id}', '{$_POST["name"]}','{$_POST["tema"]}');");
        $newConsulta = $this->findById($id);
        Logger::log("Post", "save", $newConsulta);
        return $newConsulta;
    }

  
    public function update($id, $input) 
    {
        $this->database->mysql->query("UPDATE `consultas` SET `name` = '{$input->name}', `tema` = '{$input->tema}' WHERE (`id` = '{$id}')"); 
        $consultaUpdated = $this->findById($id);
        Logger::log("Put", "Update", $consultaUpdated);
        return $consultaUpdated;
    }

    public function delete($id)
    {
        $this->database->mysql->query("DELETE FROM `consultas` WHERE `consultas`.`id`='{$id}'"); 
        Logger::log("Delete", "Delete Consulta");
    }
}