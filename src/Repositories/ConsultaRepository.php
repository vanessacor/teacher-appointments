<?php

namespace App\Repositories;

use App\Database;
use App\Logger\Logger;
use App\Models\Consulta;


class ConsultaRepository implements IRepository
{
    public $database;

    public function __construct($database)
    {
        if (!$this->database) {
            $this->database = $database;
        }
    }

    public function findAll()
    {
        $query = $this->database->mysql->query("select * FROM consultas");

        $listaConsultas = [];

        foreach ($query as $consulta) {
            $itemConsulta = new Consulta($consulta["id"], $consulta["name"],  $consulta["tema"], $consulta["fecha"]);
            array_push($listaConsultas, $itemConsulta);
        }

        Logger::log("findAll", "sucess", $listaConsultas);
        return $listaConsultas;
    }

    public function findById($id)
    {
        $query = $this->database->mysql->query("SELECT * FROM `consultas` WHERE `id` = '{$id}'");

        $result = $query->fetchAll();

        if (!isset($result[0])) {
            Logger::warning("Id", "not found");
            return;
        }

        $consulta = new Consulta($result[0]["id"], $result[0]["name"], $result[0]["tema"], $result[0]["fecha"]);
        Logger::log("findById", "sucess", $consulta);
        return $consulta;
    }

    public function save($id, $request)
    {

        $this->database->mysql->query("INSERT INTO `consultas` (`id`, `name`, `tema`) VALUES ('{$id}', '{$request->name}','{$request->tema}');");
        $newConsulta = $this->findById($id);
        Logger::log("save", "sucess", $newConsulta);
        return $newConsulta;
    }

    public function update($id, $input)
    {
        
        $this->database->mysql->query("UPDATE `consultas` SET `name` = '{$input['name']}', `tema` ='{$input['tema']}' WHERE `consultas`.`id`='{$id}'");
        $consultaUpdated = $this->findById($id);
        if (!$consultaUpdated) {
            Logger::warning("update", "not found");
            return;
        }

        Logger::log("update", "sucess", $consultaUpdated);
        return $consultaUpdated;
    }

    public function delete($id)
    {
        $this->database->mysql->query("DELETE FROM `consultas` WHERE `consultas`.`id`='{$id}'");

        Logger::log("delete", "sucess");
    }
}
