<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Jobs\ConvertVideoForDownloading;
use App\Jobs\ConvertVideoForStreaming;
use App\Video;
use Illuminate\Http\Request;

class VideoStoreController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function __invoke(Request $request)
	{
		$video = Video::create([
			'disk'          => 'videos_disk',
			'original_name' => $request->video->getClientOriginalName(),
			'path'          => $request->video->store('videos', 'videos_disk'),
			'title'         => $request->title,
		]);

		$this->dispatch(new ConvertVideoForDownloading($video));
		$this->dispatch(new ConvertVideoForStreaming($video));

		return response()->json([
			'id' => $video->id,
		], 201);
	}
}
