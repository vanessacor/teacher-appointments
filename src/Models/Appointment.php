<?php

namespace App\Models;

use DateTime;

class Appointment {

    public $id;
    public $student;
    public $subject;
    public $date;

    public function __construct($id = null, $student = "", $subject = "", $date = null)
    {
        $this->id = $id;
        $this->student = $student;
        $this->subject = $subject;
        $this->date = $this->formatDate($date);
    }

    public function formatDate($date) {
        $date = new DateTime($date);
        return $date->format('Y-m-d H:i');
    }


    

}

