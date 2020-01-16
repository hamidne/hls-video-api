<?php

namespace App\Http\Controllers\Video;

use App\Http\Resources\Video\VideoShowResource;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoShowController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Video $video
	 * @return VideoShowResource
	 */
    public function __invoke(Request $request, Video $video)
    {
		return new VideoShowResource($video);
    }
}
