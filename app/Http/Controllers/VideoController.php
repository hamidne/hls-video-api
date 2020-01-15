<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Jobs\ConvertVideoForStreaming;
use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForDownloading;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
	public function store(StoreVideoRequest $request)
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

	public function show(Video $video)
	{
		$streamUrl = Storage::disk('stream_videos')->url($video->id . '.m3u8');
		return view('video', compact('streamUrl'));
	}
}
