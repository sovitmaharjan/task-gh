<?php

namespace App\Http\Resources\Api\Client;

use App\Http\Resources\Api\EducationBackground\EducationBackgroundResource;
use App\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this['id'],
            "name" => $this['name'],
            // "gender" => $this['gender'],
            // "phone" => $this['phone'],
            // "email" => $this['email'],
            // "address" => $this['address'],
            // "nationality" => $this['nationality'],
            // "dob" => $this['dob'],
            // "education_background" => EducationBackgroundResource::collection((new ClientService)->educationBackground($this['id'])),
            // "contact_mode" => $this['contact_mode'],
            // "created_at" => date('Y-m-d H:i:s', strtotime($this['created_at'])),
            // "updated_at" => date('Y-m-d H:i:s', strtotime($this['updated_at'])),
        ];
    }
}
