<?php

namespace App\Jobs;

use FFMpeg;
use Carbon\Carbon;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ConvertVideoForStreaming implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	/**
	 * @var Video
	 */
	public $video;

	/**
	 * Create a new job instance.
	 *
	 * @param $video
	 */
	public function __construct(Video $video)
	{
		$this->video = $video;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		$streamPath = $this->video->id . '/' . Str::random(16) . '.m3u8';

		$lowBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(500);
		$midBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(1500);
		$highBitrateFormat = (new X264('libmp3lame', 'libx264'))->setKiloBitrate(3000);

		FFMpeg::fromDisk($this->video->disk)
			->open($this->video->video_path)
			->exportForHLS()
			->toDisk('stream_videos')
			->addFormat($lowBitrateFormat)
			->addFormat($midBitrateFormat)
			->addFormat($highBitrateFormat)
			->save($streamPath);

		$this->video->update(['stream_path' => $streamPath]);
	}
}
