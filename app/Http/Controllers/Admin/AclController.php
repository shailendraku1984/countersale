<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Services\Contracts\AclServiceInterface;

class AclController extends Controller
{
    protected AclServiceInterface $service;

    public function __construct(AclServiceInterface $service) {
        $this->service = $service;
    }

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Sync Permissions
        |--------------------------------------------------------------------------
        */

        $this->service->syncPermissions();

        /*
        |--------------------------------------------------------------------------
        | Get ACL List
        |--------------------------------------------------------------------------
        */

        $permissions = $this->service->paginate();

        return view('admin.acl.index',compact('permissions'));
    }
}