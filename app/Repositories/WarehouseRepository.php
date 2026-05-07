<?php

namespace App\Repositories;

use App\Models\Warehouse;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;

class WarehouseRepository implements WarehouseRepositoryInterface
{
    public function getAllPaginated()
    {
        return Warehouse::with([
            'country',
            'state',
            'city'
        ])
        ->latest()
        ->paginate(10);
    }

    public function create(array $data)
    {
        return Warehouse::create($data);
    }

    public function findById(int $id)
    {
        return Warehouse::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $warehouse = $this->findById($id);

        $warehouse->update($data);

        return $warehouse;
    }

    public function delete(int $id)
    {
        $warehouse = $this->findById($id);

        return $warehouse->delete();
    }
}