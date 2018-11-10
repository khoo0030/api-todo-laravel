<?php

namespace App\Http\Resources;

use App\Models\Todo;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var Todo $todo */
        $todo = $this;

        return [
            'id' => $todo->id,
            'title' => $todo->title,
            'created_at' => $todo->created_at->toDateTimeString(),
        ];
    }
}
