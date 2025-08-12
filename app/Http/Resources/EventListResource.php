<?php

namespace App\Http\Resources;

// use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
// use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventListResource extends JsonResource
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
            'excerpt' => Str::limit($this->excerpt, 80),
            // 'start_datetime' => DateTime::createFromFormat('Y-m-d H:i:s', $this->start_datetime)->format('Y-m-d H:i:s'),
            'start_datetime' => $this->start_datetime,
            'duration' => $this->duration,
            'location' => $this->location,
            'capacity' => $this->capacity,
            'is_active' => $this->is_active,
            'category' => $this->category->name ?? null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
