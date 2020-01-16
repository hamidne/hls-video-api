<?php

namespace App\Http\Resources\Video;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoIndexResource extends JsonResource
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
			'id'         => $this->id,
			'title'      => $this->title,
			'created_at' => $this->created_at,
			'updated_at' => $this->updated_at
		];
	}
}
