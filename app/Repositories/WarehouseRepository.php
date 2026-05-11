<?php

namespace App\Repositories;

use App\Models\Warehouse;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;

class WarehouseRepository implements WarehouseRepositoryInterface
{
    /*
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
	*/
	
	
	public function getAllPaginated(int $perPage = 10) {
		
    return Warehouse::query()->when(request('search'),
            function ($query) {
                $query->where('warehouse_name','like','%' . request('search') . '%');
            })->paginate($perPage);
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