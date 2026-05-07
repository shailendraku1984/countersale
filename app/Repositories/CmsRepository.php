<?php

namespace App\Repositories;

use App\Models\Cms;
use App\Repositories\Interfaces\CmsRepositoryInterface;

class CmsRepository implements CmsRepositoryInterface
{
    public function getAllPaginated(int $perPage = 10)
    {
        return Cms::latest()->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Cms::findOrFail($id);
    }

    public function create(array $data)
    {
        return Cms::create($data);
    }

    public function update(int $id, array $data)
    {
        $cms = $this->findById($id);

        $cms->update($data);

        return $cms;
    }

    public function delete(int $id)
    {
        $cms = $this->findById($id);

        return $cms->delete();
    }
}