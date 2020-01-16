<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoDeleteController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param Video $video
	 * @return \Illuminate\Http\Response
	 * @throws \Exception
	 */
    public function __invoke(Request $request, Video $video)
    {
        $video->delete();
        return response()->setStatusCode(204);
    }
}
