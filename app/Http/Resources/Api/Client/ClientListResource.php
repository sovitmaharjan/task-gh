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
        $data = $this->resource["data"];
        $info = $this->resource["info"] ?? "";
        return request()->page > 0 ? [
            "meta" => [
                "current_page" => $info["current_page"],
                "from" => $info["first_page"],
                "to" => $info["last_page"],
                "per_page" => $info["per_page"],
                "total" => $info["total"],
            ],
            "data" => ClientResource::collection($data),
            "links" => [
                "first" => route("client.index") . "?per_page=" . $info["per_page"] . "&page=" . $info["first_page"],
                "last" => route("client.index") . "?per_page=" . $info["per_page"] . "&page=" . $info["last_page"],
                "prev" => $info["current_page"] > 1 ? route("client.index") . "?per_page=" . $info["per_page"] . "&page=" . $info["current_page"] - 1 : "",
                "next" => $info["current_page"] < $info["last_page"] ? route("client.index") . "?per_page=" . $info["per_page"] . "&page=" . $info["current_page"] + 1 : "",
            ]
        ] : ClientResource::collection($data);
    }
}
