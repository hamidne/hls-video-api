<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
class Video extends Model
{
	protected $dates = ['converted_for_streaming_at'];

	protected $guarded = [];
}
