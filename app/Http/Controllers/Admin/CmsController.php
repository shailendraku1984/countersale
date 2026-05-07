<?php

namespace App\Http\Controllers\Admin;

use App\Services\CmsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCmsRequest;
use App\Http\Requests\UpdateCmsRequest;

class CmsController extends Controller
{
    protected CmsService $cmsService;

    public function __construct(CmsService $cmsService)
    {
        $this->cmsService = $cmsService;

    }

    public function index()
    {
        $cmsPages = $this->cmsService->getAllCms();

        return view('admin.cms.index', compact('cmsPages'));
    }

    public function create()
    {
        return view('admin.cms.create');
    }

    public function store(StoreCmsRequest $request)
    {
        $this->cmsService->store($request->validated());

        return redirect()
            ->route('admin.cms.index')
            ->with('success', 'CMS created successfully.');
    }

    public function edit(int $id)
    {
        $cms = $this->cmsService->find($id);

        return view('admin.cms.edit', compact('cms'));
    }

    public function update(UpdateCmsRequest $request, int $id)
    {
        $this->cmsService->update($id, $request->validated());

        return redirect()
            ->route('admin.cms.index')
            ->with('success', 'CMS updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->cmsService->delete($id);

        return redirect()
            ->route('admin.cms.index')
            ->with('success', 'CMS deleted successfully.');
    }
}