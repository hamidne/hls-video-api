<?php

namespace App\Http\Resources\Video;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class VideoShowResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			'id'          => $this->id,
			'title'       => $this->title,
			'stream_path' => Storage::disk('stream_videos')->url($this->stream_path),
			'created_at'  => $this->created_at,
			'updated_at'  => $this->updated_at
		];
	}
}
