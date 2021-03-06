<?php

namespace App\Controllers;

use App\Repositories\IRepository;
use App\Views\View;



class AppointmentController
{
    private IRepository $repository;


    public function __construct($repository)
    {
        $this->repository = $repository;


        if (isset($_GET) && !isset($_GET["action"])) {
            $this->index();
            return;
        }

        if (isset($_GET) && ($_GET["action"] == "create")) {
            $this->create();
            return;
        }

        if (isset($_GET) && ($_GET["action"] == "save")) {
            $this->save($_POST);
            return;
        }

        if (isset($_GET) && ($_GET["action"] == "delete")) {
            $this->delete($_GET["id"]);
            return;
        }

        if (isset($_GET) && ($_GET["action"] == "edit")) {
            $this->edit($_GET["id"]);
            return;
        }

        if (isset($_GET) && ($_GET["action"] == "update")) {
            $this->update($_POST, $_GET["id"]);
            return;
        }
    }

    public function index(): void
    {
        $appointmentList = $this->repository->findAll();

        new View("AppointmentList", ["appointmentList" => $appointmentList,]);
    }

    public function create(): void
    {
        new View("NewAppointment");
    }

    public function save($request): void
    {
        $id = uniqid();
        $this->repository->save($id, $request);

        $this->index();
    }

    public function delete($id)
    {
        $this->repository->delete($id);

        $this->index();
    }

    public function edit($id)
    {
        $appointment = $this->repository->findById($id);

        new View("EditAppointment", ["appointment" => $appointment]);
    }

    public function update(array $request, $id)
    {

        $AppointmentUpdated = $this->repository->update($id, $request);

        $this->index();
    }
}
