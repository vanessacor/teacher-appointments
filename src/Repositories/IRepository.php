<?php

namespace App\Repositories;


interface IRepository 
{
    public function findAll();

    public function findById($id);

    public function save($id, $request);

    public function update($id, $data);

    public function delete($id);    
}
