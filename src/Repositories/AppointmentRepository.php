<?php

namespace App\Repositories;

use App\Database;
use App\Logger\Logger;
use App\Models\Appointment;


class AppointmentRepository implements IRepository
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
        $query = $this->database->mysql->query("select * FROM appointment");

        $appointmentList = [];

        foreach ($query as $appointment) {
            $itemAppointment = new Appointment($appointment["id"], $appointment["student_name"],  $appointment["subject"], $appointment["appointment_date"]);
            array_push($appointmentList, $itemAppointment);
        }

        Logger::log("findAll", "sucess", $appointmentList);
        return $appointmentList;
    }

    public function findById($id)
    {
        $query = $this->database->mysql->query("SELECT * FROM `appointment` WHERE `id` = '{$id}'");

        $result = $query->fetchAll();

        if (!isset($result[0])) {
            Logger::warning("Id", "not found");
            return;
        }

        $appointment = new Appointment($result[0]["id"], $result[0]["student_name"], $result[0]["subject"], $result[0]["appointment_date"]);
        Logger::log("findById", "sucess", $appointment);
        return $appointment;
    }

    public function save($id, $request)
    {

        var_dump($request);
        $this->database->mysql->query("INSERT INTO `appointment` (`id`, `student_name`, `subject`) VALUES ('{$id}', '{$request['student']}','{$request['subject']}');");
        $newAppointment = $this->findById($id);
        Logger::log("save", "sucess", $newAppointment);
        return $newAppointment;
    }

    public function update($id, $input)
    {

        $this->database->mysql->query("UPDATE `appointment` SET `student_name` = '{$input['student']}', `subject` ='{$input['subject']}' WHERE `appointment`.`id`='{$id}'");
        $appointmentUpdated = $this->findById($id);
        if (!$appointmentUpdated) {
            Logger::warning("update", "not found");
            return;
        }

        Logger::log("update", "sucess", $appointmentUpdated);
        return $appointmentUpdated;
    }

    public function delete($id)
    {
        $this->database->mysql->query("DELETE FROM `appointment` WHERE `appointment`.`id`='{$id}'");

        Logger::log("delete", "sucess");
    }
}
