<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    protected $filename = 'file.csv';
    
    public function index()
    {
        $filePath = storage_path('app/' . $this->filename);
        if (!file_exists($filePath)) {
            $file = fopen(storage_path('app/' . $this->filename), 'w');
        }
        $file = fopen(storage_path('app/' . $this->filename), 'r');
        $data  = [];
        while ($row = fgetcsv($file)) {
            $data[] = $row;
        }
        fclose($file);
        return responseSuccess($data, 'Clients');
    }
    
    public function store()
    {
        $data = ['apple', '800'];
        $file = fopen(storage_path('app/' . $this->filename), 'a');
        fputcsv($file, $data);
        fclose($file);
        return responseSuccess($data, 'Client has been created.');
    }
}
