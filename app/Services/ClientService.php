<?php

namespace App\Services;

use App\Services\BaseService;
use App\Services\EducationBackgroundService;

class ClientService extends BaseService
{
    const MALE = "male";
    const FEMALE = "female";
    const OTHER = "other";
    const EMAIL = "email";
    const PHONE = "phone";

    protected $educationBackground;

    public function __construct()
    {
        parent::__construct(
            storage_path('app/client.csv'),
            ["id", "name", "gender", "phone", "email", "address", "nationality", "dob", "contact_mode", "created_at", "updated_at"]
        );
        $this->educationBackground = new EducationBackgroundService();
    }

    public function store($data): array
    {
        $result = parent::store($data);
        foreach ($data['education_background'] as $item) {
            $item['client_id'] = $result['id'];
            $this->educationBackground->store($item);
        }
        return $result;
    }

    public function educationBackground($clientId)
    {
        $ebArr = $this->educationBackground->list();
        $result = array_filter($ebArr, function ($item) use ($clientId) {
            return $item['client_id'] == $clientId;
        });
        return $result;
    }
}
