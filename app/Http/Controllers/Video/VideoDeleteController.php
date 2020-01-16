<?php

namespace App\Http\Controllers\Video;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class VideoDeleteController extends ApiController
{
	/**
	 * Handle the incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Video $video
	 * @return \App\Http\Controllers\json
	 * @throws \Exception
	 */
    public function __invoke(Request $request, Video $video)
    {
        $video->delete();
		Storage::disk('videos_disk')->delete($video->video_path);
		Storage::disk('stream_videos')->deleteDirectory($video->id);
        return $this->respondWithMessage(Lang::trans('message.video.delete'));
    }
}
