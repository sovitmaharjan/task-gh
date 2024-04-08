<?php

namespace App\Http\Resources\Api\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): mixed
    {
        return request()->page > 0 ? [
            "meta" => [
                "current_page" => route("client.index") . "?page=" . request()->page . "&per_page=" . request()->per_page,
                "from" => route("client.index"),
                "last_page" => route("client.index"),
                "path" => route("client.index"),
                "per_page" => route("client.index"),
                "to" => route("client.index"),
                "total" => route("client.index"),
            ],
            "data" => ClientResource::collection($this->resource),
            "links" => [
                "first" => route("client.index"),
                "last" => route("client.index"),
                "prev" => route("client.index"),
                "next" => route("client.index"),
            ]
        ] : ClientResource::collection($this->resource);
    }
}
