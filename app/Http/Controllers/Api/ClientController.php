<?php

namespace App\Http\Controllers\Api;

use App\Services\ClientService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Client\ClientResource;
use App\Http\Requests\Api\Client\ClientCreateRequest;

class ClientController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }
    
    public function index()
    {
        $clients = $this->clientService->list();
        return responseSuccess(ClientResource::collection($clients), 'Clients');
    }
    
    public function store(ClientCreateRequest $request)
    {
        $data = $request->validated();
        $client = $this->clientService->store($data);
        return responseSuccess(new ClientResource($client), 'Client has been created.');
    }
}
