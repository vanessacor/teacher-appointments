<?php

namespace App\Controllers;

use App\Repositories\IRepository;
use App\Repositories\ConsultaRepository;



class ConsultaApiController 
{
    private IRepository $repository;

    
    public function __construct($repository)
    {
        $this->repository = $repository;
    }
    
    public function processRequest(string $requestMethod, string $appointmentId = null)
    {
        switch ($requestMethod) {
            case 'GET':
                if ($appointmentId) {
                    $response = $this->getConsulta($appointmentId);
                } else {
                    $response = $this->index();
                };
                break;
            case 'POST':
                $response = $this->save();
                break;
            case 'PUT':
                $response = $this->update($appointmentId);
                break;
            case 'DELETE':
                $response = $this->delete($appointmentId);
                break;
            default:
                $response = $this->notFound();
                break;
        }
        
        http_response_code($response['code']);
        header('Content-Type: application/json');
        if (isset($response['body'])) {
            echo json_encode($response['body']);
        }
    }

    public function index()
    {
        $apppoitments = $this->repository->findAll();

        return ["body" => $apppoitments, "code" => 200];
    }

    public function getConsulta($id)
    {
        $appointment = $this->repository->findById($id);

        if (!$appointment ) {
            return $this->notFound();
        }

        return ["body" => $appointment, "code" => 200];
    }

    public function save()
    {
        $id = uniqid();
        $request = json_decode(file_get_contents('php://input'));
        $newAppointment = $this->repository->save($id, $request);
        
        return ["body" => $newAppointment, "code" => 201];
    }

    public function update($id)
    {
        $request = json_decode(file_get_contents('php://input'));
        $AppointmentUpdated = $this->repository->update($id, $request);

        if (!$AppointmentUpdated) {
            return $this->notFound();
        }

        return ["body" => $AppointmentUpdated, "code" => 200];
    }

    public function delete($id)
    {
        $this->repository->delete($id);

        // not found

        return ["code" => 204];
    }

    public function notFound()
    {
        $body = ["message" => "not found"];
        return ["body" => $body, "code" => 404];
    }
}
