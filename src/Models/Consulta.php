<?php

namespace App\Models;

use DateTime;

class Consulta {

    public $id;
    public $name;
    public $tema;
    public $fecha;

    public function __construct($id = null, $name = "", $tema = "", $fecha = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->tema = $tema;
        $this->fecha = $this->formatDate($fecha);
    }

    public function formatDate($fecha) {
        $date = new DateTime($fecha);
        return $date->format('Y-m-d H:i');
    }


    

}

