<?php

namespace App\Http\Controllers\Api;

use App\Services\FileService;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    protected $fileService, $filePath;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
        $this->filePath = storage_path('app/client.csv');
    }
    
    public function index()
    {
        $result = $this->fileService->list($this->filePath, READ);
        return responseSuccess($result, 'Clients');
    }
    
    public function store()
    {
        $data = ['apple', '800'];
        $result = $this->fileService->store($this->filePath, APPEND, $data);
        return responseSuccess($result, 'Client has been created.');
    }
}
