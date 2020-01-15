<?php

namespace App\Http\Controllers\Video;

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
	 * @return void
	 */
    public function __invoke(Request $request, Video $video)
    {
        //
    }
}
