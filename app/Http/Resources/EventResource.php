<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => Storage::disk('public')->url($this->image),
            'description' => $this->description,
            'start_datetime' => $this->start_datetime,
            'end_datetime' => $this->end_datetime,
            'location' => $this->location,
            'capacity' => $this->capacity,
            'is_active' => $this->is_active,
            'category' => $this->category->name ?? null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
