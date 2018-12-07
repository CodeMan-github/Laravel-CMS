jQuery(document).ready(function($) {

	// FitVids
	$("main").fitVids();

	//Size vid to fit window - must be pixels
	$(function(){
		$(window).load(function(){ // On load
			var windowHeight = $(window).height();

			$('iframe').css({'height':(windowHeight)+'px'});
			$('iframe').css({'width':(($(window).width()))+'px'});
			});

		$(window).resize(function(){ // On resize
			var windowHeight = $(window).height();

			$('iframe').css({'height':(windowHeight)+'px'});
			$('iframe').css({'width':(($(window).width()))+'px'});
			});
		});

	//Video Manipulation
	(function () {

		//Variables
		var iframe = $('#player1')[0],
			player = $f(iframe),
			status = $('.status');

		// When the player is ready, add listeners for pause, finish, and playProgress
		player.addEvent('ready', function() {
			player.addEvent('finish', onFinish);
			});

		// Call the API when a button is pressed
		$('.play-button').bind('click', function() {
			$('.splash-content').addClass('vid-play');
			$('.splash-inner-content').addClass('move-type');
			$('.vid-play').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
			function(e) {
				$(this).hide();
				});
			player.api('play');
			});

		//Function to close the video
		var closeVideo = function() {
			player.api('unload');
			$('.splash-content').removeClass('vid-play').show();
			$('.splash-inner-content').removeClass('move-type');
			};

		//Close video when "close" button is clicked
		$('.close-vid').bind('click', closeVideo);

		//Close video when escape key is pressed
		$(document).keydown(function(e) {
			if (e.keyCode == 27) {
				closeVideo();
				e.preventDefault();
				}
			});

		//Close the video when it is over
		function onFinish(id) {
			closeVideo();
			};

	}());
	
});