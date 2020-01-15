<?php

namespace App\Http\Controllers\Video;

use App\Models\Video;
use App\Http\Controllers\Controller;
use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\ConvertVideoForDownloading;
use App\Http\Requests\Video\VideoStoreRequest;

class VideoStoreController extends Controller
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
			'disk'  => 'videos_disk',
			'path'  => $request->video->store('videos', 'videos_disk'),
			'title' => $request->title,
		]);

		$this->dispatch(new ConvertVideoForStreaming($video));

		return response()->json([
			'id' => $video->id,
		], 201);
	}
}
