<?php

namespace App\Http\Controllers\Video;

use App\Http\Controllers\Controller;
use App\Http\Resources\Video\VideoIndexResource;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoIndexController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
    public function __invoke(Request $request)
    {
        $videos = Video::query()->paginate();
        return VideoIndexResource::collection($videos);
    }
}
