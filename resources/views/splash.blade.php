<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
   @if($settings_general->site_post_as_titles == 1)
        <title>{{$post->title}}</title>
    @else
        <title>{{$settings_general->site_title}}</title>
    @endif

    <meta name="description" content="{{\Illuminate\Support\Str::limit(trim(strip_tags($post->description)),300)}}">
	<meta property="og:image" content="{{$post->featured_image}}"/>
	<meta property="og:site_name" content="{{$settings_general->site_title}}"/>
    <meta property="og:title" content="{{$post->title}}"/>
    <meta property="og:description"
          content="{{\Illuminate\Support\Str::limit(trim(strip_tags($post->description)),300)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="{{URL::to($post->slug)}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
    <link rel="stylesheet" href="/css/splash.css">

  
</head>

<body>

  <main>
	<div class="splash">
		<!--<div class="vid-holder">
		
			<h1>POSTS ARE UNDERNEATH</h1>
									
		</div> -->

		<div style="color:#fff" class="splash-content">
			<div class="splash-inner-content">
				{!! $splash_page_content !!}
				<p><button onclick="location.href='{{$redirect_url}}'" class="play-button">Visit link</button></p>
			</div>
		</div>
	</div>
</main>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fitvids/1.1.0/jquery.fitvids.min.js'></script>
<script src='https://f.vimeocdn.com/js/froogaloop2.min.js'></script>

 
<script  src="/js/splash.js"></script>


</body>

</html>
