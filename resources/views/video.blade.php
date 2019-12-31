<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link href="//vjs.zencdn.net/7.3.0/video-js.min.css" rel="stylesheet">
</head>
<body>
{{--{{ $streamUrl }}--}}
{{--<video src="{{ env('APP_URL') . $streamUrl }}"></video>--}}
{{--<script src="//vjs.zencdn.net/7.3.0/video.min.js"></script>--}}

<video-js id=vid1 width=600 height=300 class="vjs-default-skin" controls>
	<source
		src="{{ env('APP_URL') . $streamUrl }}"
		type="application/x-mpegURL">
</video-js>
<script src="//vjs.zencdn.net/7.3.0/video.min.js"></script>
<script src="https://unpkg.com/browse/@videojs/http-streaming@1.11.2/dist/videojs-http-streaming.min.js"></script>
<script>
	var player = videojs('vid1');
	player.play();
</script>

</body>
</html>
