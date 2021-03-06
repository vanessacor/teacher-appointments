<?php

namespace App\Repositories;

use App\Database;
use App\Logger\Logger;
use App\Models\Appointment;

class ApiRepository implements IRepository
{
    public $database;

    public function __construct($database)
    {
        if (!$this->database) {
            $this->database = $database;
        }
    }

    public function FindAll()
    {
        $query = $this->database->mysql->query("select * FROM appointments");
        $appointmentList = [];

        foreach ($query as $appointment) {
            $itemAppointment = new Appointment($appointment["id"], $appointment["name"],  $appointment["tema"], $appointment["fecha"]);
            array_push($appointmentList, $itemAppointment);
        }

        Logger::log("get", "createList", $appointmentList);
        return json_encode($appointmentList);
    }

    public function findById($id)
    {
        $query = $this->database->mysql->query("SELECT * FROM `appointments` WHERE `id` = '{$id}'");

        $result = $query->fetchAll();
        $appointment = new Appointment($result[0]["id"], $result[0]["student_name"], $result[0]["subject"], $result[0]["appointment_date"]);
        Logger::log("FindByID", "find", $appointment);
        return $appointment;
    }

    public function save($id, $request)
    {

        $this->database->mysql->query("INSERT INTO `appointments` (`id`, `student_name`, `subject`) VALUES ('{$id}', '{$_POST["student"]}','{$_POST["subject"]}');");
        $newAppointment = $this->findById($id);
        Logger::log("Post", "save", $newAppointment);
        return $newAppointment;
    }


    public function update($id, $input)
    {
        $this->database->mysql->query("UPDATE `appointments` SET `student_name` = '{$input->student}', `subject` = '{$input->subject}' WHERE (`id` = '{$id}')");
        $appointmentUpdated = $this->findById($id);
        Logger::log("Put", "Update", $appointmentUpdated);
        return $appointmentUpdated;
    }

    public function delete($id)
    {
        $this->database->mysql->query("DELETE FROM `appointments` WHERE `appointments`.`id`='{$id}'");
        Logger::log("Delete", "Delete Appointment");
    }
}
