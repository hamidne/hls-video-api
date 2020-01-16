<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\ApiController;
use App\Http\Resources\Video\VideoShowResource;
use App\Models\Video;
use App\Jobs\ConvertVideoForStreaming;
use App\Http\Requests\Video\VideoStoreRequest;

class VideoStoreController extends ApiController
{
	/**
	 * Handle the incoming request.
	 *
	 * @param VideoStoreRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function __invoke(VideoStoreRequest $request)
	{
		$video = Video::create([
			'disk'       => 'videos_disk',
			'video_path' => $request->video->store('videos', 'videos_disk'),
			'title'      => $request->title,
		]);

		$this->dispatch(new ConvertVideoForStreaming($video));

		return $this
			->setStatusCode(201)
			->respondWithCollection(new VideoShowResource($video), []);
	}
}
