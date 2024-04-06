<?php

namespace App\Http\Controllers\Api;

use App\Services\ClientService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Client\ClientCreateRequest;

class ClientController extends Controller
{
    protected $clientService, $filePath;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
        $this->filePath = storage_path('app/client.csv');
    }
    
    public function index()
    {
        $result = $this->clientService->list($this->filePath, READ);
        return responseSuccess($result, 'Clients');
    }
    
    public function store(ClientCreateRequest $request)
    {
        $data = $request->validated();
        $result = $this->clientService->store($this->filePath, APPEND, $data);
        return responseSuccess($result, 'Client has been created.');
    }
}
