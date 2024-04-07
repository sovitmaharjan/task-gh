<?php

namespace App\Http\Resources\Api\EducationBackground;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EducationBackgroundResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'level' => $this['level'],
            'graduated_year' => $this['graduated_year'],
        ];
    }
}
