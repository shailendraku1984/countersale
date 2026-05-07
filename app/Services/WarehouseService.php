<?php

namespace App\Services;

use App\Repositories\Interfaces\WarehouseRepositoryInterface;

class WarehouseService
{
    protected WarehouseRepositoryInterface $repository;

    public function __construct(
        WarehouseRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAllPaginated();
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function find(int $id)
    {
        return $this->repository->findById($id);
    }

    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}