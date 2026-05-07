<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Repositories\Interfaces\CmsRepositoryInterface;

class CmsService
{
    protected CmsRepositoryInterface $cmsRepository;

    public function __construct(
        CmsRepositoryInterface $cmsRepository
    ) {
        $this->cmsRepository = $cmsRepository;
    }

    public function getAllCms()
    {
        return $this->cmsRepository->getAllPaginated();
    }

    public function store(array $data)
    {
        $data['slug'] = Str::slug($data['title']);

        return $this->cmsRepository->create($data);
    }

    public function find(int $id)
    {
        return $this->cmsRepository->findById($id);
    }

    public function update(int $id, array $data)
    {
        $data['slug'] = Str::slug($data['title']);

        return $this->cmsRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->cmsRepository->delete($id);
    }
}