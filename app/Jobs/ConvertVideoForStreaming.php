<?php

namespace App\Jobs;

use FFMpeg;
use App\Models\Video;
use Carbon\Carbon;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Pbmedia\LaravelFFMpeg\Disk;

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
		$bitrateFormat = (new X264('libmp3lame', 'libx264'));
		$lowBitrateFormat = $bitrateFormat->setKiloBitrate(500);
		$midBitrateFormat = $bitrateFormat->setKiloBitrate(1500);
		$highBitrateFormat = $bitrateFormat->setKiloBitrate(3000);

		FFMpeg::fromDisk($this->video->disk)
			->open($this->video->path)
			->exportForHLS()
			->toDisk('stream_videos')
			->addFormat($lowBitrateFormat)
			->addFormat($midBitrateFormat)
			->addFormat($highBitrateFormat)
			->save("{$this->video->id}/{$this->video->id}.m3u8");

		$this->video->update([
			'converted_for_streaming_at' => Carbon::now(),
		]);
	}
}
