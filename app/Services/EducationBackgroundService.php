<?php

namespace App\Services;

use App\Services\BaseService;

class EducationBackgroundService extends BaseService
{
    public function __construct()
    {
        parent::__construct(
            storage_path('app/education_background.csv'),
            ["id", "level", "graduated_year", "client_id"]
        );
    }

    public function list(): array
    {
        $result  = [];
        if (!file_exists($this->filePath)) {
            $file = fopen($this->filePath, "w");
        } else {
            $file = fopen($this->filePath, "r");
            while ($row = fgetcsv($file)) {
                $result[] = $this->makeAssoc($row, $this->columns);
            }
        }
        fclose($file);
        return $result;
    }
}
