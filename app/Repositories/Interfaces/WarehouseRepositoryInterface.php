<?php

namespace App\Repositories\Interfaces;

interface WarehouseRepositoryInterface
{
    public function getAllPaginated();

    public function create(array $data);

    public function findById(int $id);

    public function update(int $id, array $data);

    public function delete(int $id);
}