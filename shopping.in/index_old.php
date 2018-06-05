<?php
session_start();
include 'login/connect.php';
$companytitle=mysql_query("SELECT * FROM ais_company_info")or die(mysql_error());
if(mysql_num_rows($companytitle)>=1)
{
	$companytitle=mysql_fetch_array($companytitle);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="setting/favicon.ico">
	<link rel="stylesheet" type="text/css" href="setting/assets/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/lib/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/lib/owl.carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/lib/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/css/global.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="setting/assets/css/option3.css" />
	<link href="https://fonts.googleapis.com/css?family=Playball" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<style>
	::-webkit-scrollbar {width:10px;background-color:#FFFFFF;} /* this targets the default scrollbar (compulsory) */
	::-webkit-scrollbar-track {-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);}
	::-webkit-scrollbar-thumb{background-color:#fd7400;outline: 1px solid slategrey;}
	</style>
	<script type="text/javascript" src="setting/assets/js/jssor.slider-21.1.6.min.js"></script>
	<script>
		var _SlideshowTransitionC = {};
        var _SlideshowTransitionCodes = {};
        var _SlideshowTransitions = [];


        //----------- Flutter Outside Effects --------------
        {

            _SlideshowTransitionC["Flutter Outside in"] = { $Duration: 1800, x: 1, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7] }, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Clip: $JssorEasing$.$EaseInOutQuad }, $Outside: true, $Round: { $Top: 0.8 } };
            _SlideshowTransitionCodes["Flutter Outside in"] = "{$Duration:1800,x:1,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo,$Clip:$JssorEasing$.$EaseInOutQuad},$Outside:true,$Round:{$Top:0.8}}";

            _SlideshowTransitionC["Flutter Outside in Wind"] = { $Duration: 1800, x: 1, y: 0.2, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $Reverse: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 2050, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseOutWave, $Clip: $JssorEasing$.$EaseInOutQuad }, $Outside: true, $Round: { $Top: 1.3 } };
            _SlideshowTransitionCodes["Flutter Outside in Wind"] = "{$Duration:1800,x:1,y:0.2,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Easing:{$Left:$JssorEasing$.$EaseInOutSine,$Top:$JssorEasing$.$EaseOutWave,$Clip:$JssorEasing$.$EaseInOutQuad},$Outside:true,$Round:{$Top:1.3}}";

            _SlideshowTransitionC["Flutter Outside in Swirl"] = { $Duration: 1800, x: 1, y: 0.2, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $Reverse: true, $Formation: $JssorSlideshowFormations$.$FormationSwirl, $Assembly: 2050, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseOutWave, $Clip: $JssorEasing$.$EaseInOutQuad }, $Outside: true, $Round: { $Top: 1.3 } };
            _SlideshowTransitionCodes["Flutter Outside in Swirl"] = "{$Duration:1800,x:1,y:0.2,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:2050,$Easing:{$Left:$JssorEasing$.$EaseInOutSine,$Top:$JssorEasing$.$EaseOutWave,$Clip:$JssorEasing$.$EaseInOutQuad},$Outside:true,$Round:{$Top:1.3}}";

            _SlideshowTransitionC["Flutter Outside in Column"] = { $Duration: 1500, x: 0.2, y: -0.1, $Delay: 150, $Cols: 12, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseOutWave, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true, $Round: { $Top: 2 } };
            _SlideshowTransitionCodes["Flutter Outside in Column"] = "{$Duration:1500,x:0.2,y:-0.1,$Delay:150,$Cols:12,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$JssorEasing$.$EaseLinear,$Top:$JssorEasing$.$EaseOutWave,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2,$Outside:true,$Round:{$Top:2}}";

            _SlideshowTransitionC["Flutter Outside out"] = { $Duration: 1800, x: 1, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7] }, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Clip: $JssorEasing$.$EaseInOutQuad }, $Outside: true, $Round: { $Top: 0.8 } };
            _SlideshowTransitionCodes["Flutter Outside out"] = "{$Duration:1800,x:1,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo,$Clip:$JssorEasing$.$EaseInOutQuad},$Outside:true,$Round:{$Top:0.8}}";

            _SlideshowTransitionC["Flutter Outside out Wind"] = { $Duration: 1800, x: 1, y: 0.2, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $Reverse: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 2050, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseOutWave, $Clip: $JssorEasing$.$EaseInOutQuad }, $Outside: true, $Round: { $Top: 1.3 } };
            _SlideshowTransitionCodes["Flutter Outside out Wind"] = "{$Duration:1800,x:1,y:0.2,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Easing:{$Left:$JssorEasing$.$EaseInOutSine,$Top:$JssorEasing$.$EaseOutWave,$Clip:$JssorEasing$.$EaseInOutQuad},$Outside:true,$Round:{$Top:1.3}}";

            _SlideshowTransitionC["Flutter Outside out Swirl"] = { $Duration: 1800, x: 1, y: 0.2, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $Reverse: true, $Formation: $JssorSlideshowFormations$.$FormationSwirl, $Assembly: 2050, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseOutWave, $Clip: $JssorEasing$.$EaseInOutQuad }, $Outside: true, $Round: { $Top: 1.3 } };
            _SlideshowTransitionCodes["Flutter Outside out Swirl"] = "{$Duration:1800,x:1,y:0.2,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:2050,$Easing:{$Left:$JssorEasing$.$EaseInOutSine,$Top:$JssorEasing$.$EaseOutWave,$Clip:$JssorEasing$.$EaseInOutQuad},$Outside:true,$Round:{$Top:1.3}}";

            _SlideshowTransitionC["Flutter Outside out Column"] = { $Duration: 1500, x: 0.2, y: -0.1, $Delay: 150, $Cols: 12, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseOutWave, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Outside: true, $Round: { $Top: 2 } };
            _SlideshowTransitionCodes["Flutter Outside out Column"] = "{$Duration:1500,x:0.2,y:-0.1,$Delay:150,$Cols:12,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$JssorEasing$.$EaseLinear,$Top:$JssorEasing$.$EaseOutWave,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2,$Outside:true,$Round:{$Top:2}}";
        }

        //----------- Flutter Inside Effects --------------
        {

            _SlideshowTransitionC["Flutter Inside in"] = { $Duration: 1800, x: 1, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7] }, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Clip: $JssorEasing$.$EaseInOutQuad }, $Round: { $Top: 0.8 } };
            _SlideshowTransitionCodes["Flutter Inside in"] = "{$Duration:1800,x:1,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7]},$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo,$Clip:$JssorEasing$.$EaseInOutQuad},$Round:{$Top:0.8}}";

            _SlideshowTransitionC["Flutter Inside in Wind"] = { $Duration: 1800, x: 1, y: 0.2, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $Reverse: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 2050, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseOutWave, $Clip: $JssorEasing$.$EaseInOutQuad }, $Round: { $Top: 1.3 } };
            _SlideshowTransitionCodes["Flutter Inside in Wind"] = "{$Duration:1800,x:1,y:0.2,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Easing:{$Left:$JssorEasing$.$EaseInOutSine,$Top:$JssorEasing$.$EaseOutWave,$Clip:$JssorEasing$.$EaseInOutQuad},$Round:{$Top:1.3}}";

            _SlideshowTransitionC["Flutter Inside in Swirl"] = { $Duration: 1800, x: 1, y: 0.2, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $Reverse: true, $Formation: $JssorSlideshowFormations$.$FormationSwirl, $Assembly: 2050, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseOutWave, $Clip: $JssorEasing$.$EaseInOutQuad }, $Round: { $Top: 1.3 } };
            _SlideshowTransitionCodes["Flutter Inside in Swirl"] = "{$Duration:1800,x:1,y:0.2,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:2050,$Easing:{$Left:$JssorEasing$.$EaseInOutSine,$Top:$JssorEasing$.$EaseOutWave,$Clip:$JssorEasing$.$EaseInOutQuad},$Round:{$Top:1.3}}";

            _SlideshowTransitionC["Flutter Inside in Column"] = { $Duration: 1500, x: 0.2, y: -0.1, $Delay: 150, $Cols: 12, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseOutWave, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Round: { $Top: 2 } };
            _SlideshowTransitionCodes["Flutter Inside in Column"] = "{$Duration:1500,x:0.2,y:-0.1,$Delay:150,$Cols:12,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$JssorEasing$.$EaseLinear,$Top:$JssorEasing$.$EaseOutWave,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2,$Round:{$Top:2}}";

            _SlideshowTransitionC["Flutter Inside out"] = { $Duration: 1800, x: 1, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7] }, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseInOutExpo, $Clip: $JssorEasing$.$EaseInOutQuad }, $Round: { $Top: 0.8 } };
            _SlideshowTransitionCodes["Flutter Inside out"] = "{$Duration:1800,x:1,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7]},$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$JssorEasing$.$EaseInOutExpo,$Clip:$JssorEasing$.$EaseInOutQuad},$Round:{$Top:0.8}}";

            _SlideshowTransitionC["Flutter Inside out Wind"] = { $Duration: 1800, x: 1, y: 0.2, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $Reverse: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 2050, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseOutWave, $Clip: $JssorEasing$.$EaseInOutQuad }, $Round: { $Top: 1.3 } };
            _SlideshowTransitionCodes["Flutter Inside out Wind"] = "{$Duration:1800,x:1,y:0.2,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:2050,$Easing:{$Left:$JssorEasing$.$EaseInOutSine,$Top:$JssorEasing$.$EaseOutWave,$Clip:$JssorEasing$.$EaseInOutQuad},$Round:{$Top:1.3}}";

            _SlideshowTransitionC["Flutter Inside out Swirl"] = { $Duration: 1800, x: 1, y: 0.2, $Delay: 30, $Cols: 10, $Rows: 5, $Clip: 15, $During: { $Left: [0.3, 0.7], $Top: [0.3, 0.7] }, $SlideOut: true, $Reverse: true, $Formation: $JssorSlideshowFormations$.$FormationSwirl, $Assembly: 2050, $Easing: { $Left: $JssorEasing$.$EaseInOutSine, $Top: $JssorEasing$.$EaseOutWave, $Clip: $JssorEasing$.$EaseInOutQuad }, $Round: { $Top: 1.3 } };
            _SlideshowTransitionCodes["Flutter Inside out Swirl"] = "{$Duration:1800,x:1,y:0.2,$Delay:30,$Cols:10,$Rows:5,$Clip:15,$During:{$Left:[0.3,0.7],$Top:[0.3,0.7]},$SlideOut:true,$Reverse:true,$Formation:$JssorSlideshowFormations$.$FormationSwirl,$Assembly:2050,$Easing:{$Left:$JssorEasing$.$EaseInOutSine,$Top:$JssorEasing$.$EaseOutWave,$Clip:$JssorEasing$.$EaseInOutQuad},$Round:{$Top:1.3}}";

            _SlideshowTransitionC["Flutter Inside out Column"] = { $Duration: 1500, x: 0.2, y: -0.1, $Delay: 150, $Cols: 12, $SlideOut: true, $Formation: $JssorSlideshowFormations$.$FormationStraightStairs, $Assembly: 260, $Easing: { $Left: $JssorEasing$.$EaseLinear, $Top: $JssorEasing$.$EaseOutWave, $Opacity: $JssorEasing$.$EaseLinear }, $Opacity: 2, $Round: { $Top: 2 } };
            _SlideshowTransitionCodes["Flutter Inside out Column"] = "{$Duration:1500,x:0.2,y:-0.1,$Delay:150,$Cols:12,$SlideOut:true,$Formation:$JssorSlideshowFormations$.$FormationStraightStairs,$Assembly:260,$Easing:{$Left:$JssorEasing$.$EaseLinear,$Top:$JssorEasing$.$EaseOutWave,$Opacity:$JssorEasing$.$EaseLinear},$Opacity:2,$Round:{$Top:2}}";
        }

        $Jssor$.$Each(_SlideshowTransitionC, function (slideshowTransition, name) {
            _SlideshowTransitions.push(slideshowTransition);
        });
	</script>
	<script>
        jssor_slider1_starter = function (containerId) {
            var jssor_slider1 = new $JssorSlider$(containerId, {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $Idle: 400,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $Cols is greater than 1, or parking position is not 0)
                $PauseOnHover: 1,                                   //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
                    $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
                    $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
                    $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
                    $ShowLink: true                                 //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
                }
            });

            PlaySlideshowTransition = function (event) {
                $Jssor$.$StopEvent(event);
                $Jssor$.$CancelEvent(event);

                try {
                    var eventSrcElement = $Jssor$.$EvtSrc(event);
                    var transitionName = $Jssor$.$InnerText(eventSrcElement);
                    jssor_slider1.$Next();

                    jssor_slider1.$SetSlideshowTransitions([_SlideshowTransitionC[transitionName]]);

                    var effectStr = _SlideshowTransitionCodes[transitionName];

                    if (transitionNameTextBox) {
                        transitionNameTextBox.value = transitionName;
                    }
                    if (transitionCodeTextBox) {
                        transitionCodeTextBox.value = effectStr;
                    }
                }
                catch (e) { }
            }

            TransitionTextBoxClickEventHandler = function (event) {
                transitionCodeTextBox.select();

                $Jssor$.$CancelEvent(event);
                $Jssor$.$StopEvent(event);
            }

            var transitionCodeTextBox = $Jssor$.$GetElement("stTransition");
            var transitionNameTextBox = $Jssor$.$GetElement("stTransitionName");
            $Jssor$.$AddEvent(transitionCodeTextBox, "click", TransitionTextBoxClickEventHandler);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizing
            function ScaleSlider() {
                var bodyWidth = document.body.clientWidth;
                if (bodyWidth)
                    jssor_slider1.$ScaleWidth(Math.min(bodyWidth, 600));
                else
                    $Jssor$.$Delay(ScaleSlider, 30);
            }

            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);

            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        };
    </script>
	<title><?php echo $companytitle['company_name'];?></title>
</head>
<body class="option3" onload="onLoad()">
	<!--LOADER AJAX-->
	<script>
		function compareProduct(myvalue)
		{
			var xmlhttp;
			document.getElementById('loaderAjax').style.display="block";
			if (window.XMLHttpRequest)
			{// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else
			{// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}	
			xmlhttp.onreadystatechange = function()
			{
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					if(xmlhttp.responseText==3)
					{
						window.location="compare.php";
					}
					document.getElementById('loaderAjax').style.display="none";
				}
			}
			xmlhttp.open("GET","web_require/web_ajax/ajax_compare.php?productid="+myvalue, true);
			xmlhttp.send();
		}
	</script>
	<!--END OF LOADER AJAX-->
	<!-- header -->
	<?php include 'web_require/header.php';?>
	<!-- ./header -->
	<div class="container">
		<div class="row">
			<div class="col-sm-12" id="aissliderdiv">
				<!-- Jssor Slider Begin -->
				<!-- To move inline styles to css file/block, please specify a class name for each element. -->
				<div id="slider1_container" style="margin:0px;width:1168px;height:400px;left:0px;top:0px;">
					<!-- Slides Container -->
					<div u="slides" id="myslider" style="cursor:move;left:0px;top:0px;width:1168px;height:400px;overflow:hidden;">
						<?php
							$indexbanner=mysql_query("SELECT * FROM ais_indexbanner ORDER BY rand()")or die(mysql_error().'indexbanner');
							if(mysql_num_rows($indexbanner)>=1)
							{
								if(mysql_num_rows($indexbanner)<4)
								{
									while($inbanrow=mysql_fetch_array($indexbanner))
									{
										echo '<div>
											<img u="image" src="login/setting/images/indexbanner/'.$inbanrow['indexbanner'].'"/>
											<img u="thumb" src="login/setting/images/indexbanner/'.$inbanrow['indexbanner'].'"/>
										</div>';
									}
								}
								else
								{
									for($loop=0;$loop<5;$loop++)
									{
										$inbanrow=mysql_fetch_array($indexbanner);
										echo '<div>
											<img u="image" src="login/setting/images/indexbanner/'.$inbanrow['indexbanner'].'"/>
											<img u="thumb" src="login/setting/images/indexbanner/'.$inbanrow['indexbanner'].'"/>
										</div>';
									}
								}
							}
						?>
					</div>
					<!-- Trigger -->
					<script>jssor_slider1_starter("slider1_container");</script>
				</div>
				<!-- Jssor Slider End -->
				<!--#region slideshow codes-->
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="row">
				<div class="col-sm-4 col-md-3 col-lg-3">
					<!-- Block vertical-menu -->
					<div class="block block-vertical-menu">
						<div class="vertical-head">
							<h5 class="vertical-title">Categories</h5>
						</div>
						<div class="vertical-menu-content" style="height:400px;overflow:auto;">
	                        <ul class="vertical-menu-list">
								<?php
								$categories=mysql_query("SELECT * FROM manage_category WHERE deleted='0'")or die(mysql_error());
								if(mysql_num_rows($categories)>=1)
								{
									$maxcate=mysql_num_rows($categories);
									if($maxcate>10)
									{
										$maxcate=10;
									}
									while($row=mysql_fetch_array($categories))
									{
										echo '<li class="vertical-menu1"><a href="category.php?category='.$row['id'].'">'.$row['name'].'</a></li>';
									}
								}
								?>
	                        </ul>
	                    </div>
					</div>
					<!-- ./Block vertical-menu -->
				</div>
				<div class="col-sm-8 col-md-9">
				<!-- new-arrivals -->
					<div class="block3 block-new-arrivals">
									<div class="block-head">
										<h3 class="block-title">new arrivals</h3>
										<ul class="nav-tab default">
						<?php
						echo '</ul>
									</div>
									<div class="block-inner">
										<div class="tab-container">';
										echo '<div id="tab-1" class="tab-panel active">';
										echo '<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive=\'{"0":{"items":1},"600":{"items":3},"768":{"items":2},"1000":{"items":3},"1200":{"items":4}}\'>';
											$product=mysql_query("SELECT * FROM manage_product_master WHERE old_sale_price<='0' AND status='1' AND deleted='0' ORDER BY id DESC")or die(mysql_error());
											if(mysql_num_rows($product)>=1)
											{
												$maxrow=mysql_num_rows($product);
												if($maxrow>12)
												{
													$maxrow=12;
												}
												for($i=0;$i<$maxrow;$i++)
												{
													echo '<li class="product">
														<div class="product-container">
															<div class="product-left">
																<div class="product-thumb">
																	<a class="product-img" href="product_details.php?id='.mysql_result($product,$i,"id").'"><img src="login/product/'.mysql_result($product,$i,'imgpath1').'"></a>
																	<a title="Quick View" href="product_details.php?id='.mysql_result($product,$i,"id").'" class="btn-quick-view">Quick View</a>
																</div>
															</div>
															<div class="product-right">
																<div class="product-name">
																	<a href="product_details.php?id='.mysql_result($product,$i,"id").'">'.mysql_result($product,$i,'product_name').'</a>
																</div>
																<div class="price-box">
																	<span class="product-price">Rs.'.round(mysql_result($product,$i,'sale_price')+((mysql_result($product,$i,'sale_price')*mysql_result($product,$i,'tax'))/100)).'</span>';
																	if(mysql_result($product,$i,'old_sale_price')>0)
																	{
																		echo '<span class="product-price-old">Rs.'.mysql_result($product,$i,'old_sale_price').'</span>';
																	}
																echo '</div>
																<div class="product-button">
																	<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.mysql_result($product,$i,"id").')">Add Compare</a>
																	<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.mysql_result($product,$i,"id").'">Buy<span class="icon"></span></a>
																</div>
															</div>
														</div>
													</li>';
												}
											echo '</ul>';
											}
										echo '</div>';
									echo '</div>
								</div>
					</div>';
						?>
				<!-- end-of-new-arrivals -->
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-md-3">
					<!-- specail -->
					<div class="block block-specail3">
						<div class="block-head">
							<h4 class="widget-title">Special</h4>
						</div>
						<div class="block-inner">
							<ul class="products kt-owl-carousel" data-items="1" data-autoplay="true" data-loop="false" data-nav="true">
							<?php
								$special=mysql_query("SELECT * FROM manage_product_master WHERE special='1' AND status='1' AND deleted='0'")or die(mysql_error());
								if(mysql_num_rows($special)>=1)
								{
									$maxrow=mysql_num_rows($special);
									for($i=0;$i<$maxrow;$i++)
									{
										echo '<li class="product">
												<div class="product-container">
													<div class="product-left">
														<div class="product-thumb">
															<a class="product-img" href="product_details.php?id='.mysql_result($special,$i,'id').'"><img src="login/product/'.mysql_result($special,$i,'imgpath1').'"></a>
															<a title="Quick View" href="product_details.php?id='.mysql_result($special,$i,'id').'" class="btn-quick-view">Quick View</a>
														</div>
														<div class="product-status">
															<span class="new">New</span>
														</div>
													</div>
													<div class="product-right">
														<div class="product-name">
															<a href="product_details.php?id='.mysql_result($special,$i,'id').'">'.mysql_result($special,$i,'product_name').'</a>
														</div>
														<div class="price-box">
															<span class="product-price">Rs.'.round(mysql_result($special,$i,'sale_price')+((mysql_result($special,$i,'sale_price')*mysql_result($special,$i,'tax'))/100)).'</span>';
															if(mysql_result($special,$i,'old_sale_price')>0)
															{
																echo '<span class="product-price-old">Rs.'.mysql_result($special,$i,'old_sale_price').'</span>';
															}
														echo '</div>
														<div class="product-button">
															<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.mysql_result($special,$i,"id").')">Add Compare</a>
															<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.mysql_result($special,$i,'id').'">Buy<span class="icon"></span></a>
														</div>
													</div>
												</div>
											</li>';
									}
								}
								?>
							</ul>
						</div>
					</div>
					<!-- ./specail -->
				</div>
				<div class="col-sm-8 col-md-9">
				<!-- Hot deals -->
					<div class="block3 block-hotdeals">
						<div class="block-head">
									<h3 class="block-title">features</h3>
									<ul class="nav-tab default">
						<?php
						echo '</ul>
								</div>
								<div class="block-inner">
									<div class="tab-container">';
									echo '<div id="tab-1" class="tab-panel active">';
									echo '<ul class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive=\'{"0":{"items":1},"600":{"items":3},"768":{"items":2},"1000":{"items":3},"1200":{"items":4}}\'>';
										$product=mysql_query("SELECT * FROM manage_product_master WHERE old_sale_price<='0' AND status='1' AND deleted='0' ORDER BY id")or die(mysql_error());
										if(mysql_num_rows($product)>=1)
										{
											$maxrow=mysql_num_rows($product);
											if($maxrow>12)
											{
												$maxrow=12;
											}
											for($i=0;$i<$maxrow;$i++)
											{
												echo '<li class="product">
													<div class="product-container">
														<div class="product-left">
															<div class="product-thumb">
																<a class="product-img" href="product_details.php?id='.mysql_result($product,$i,"id").'"><img src="login/product/'.mysql_result($product,$i,'imgpath1').'"></a>
																<a title="Quick View" href="product_details.php?id='.mysql_result($product,$i,"id").'" class="btn-quick-view">Quick View</a>
															</div>
														</div>
														<div class="product-right">
															<div class="product-name">
																<a href="product_details.php?id='.mysql_result($product,$i,"id").'">'.mysql_result($product,$i,'product_name').'</a>
															</div>
															<div class="price-box">
																<span class="product-price">Rs.'.round(mysql_result($product,$i,'sale_price')+((mysql_result($product,$i,'sale_price')*mysql_result($product,$i,'tax'))/100)).'</span>';
																if(mysql_result($product,$i,'old_sale_price')>0)
																{
																	echo '<span class="product-price-old">Rs.'.mysql_result($product,$i,'old_sale_price').'</span>';
																}
															echo '</div>
															<div class="product-button">
																<a class="btn-add-comparre" title="Add to Compare" href="javascript:compareProduct('.mysql_result($product,$i,"id").')">Add Compare</a>
																<a class="button-radius btn-add-cart" title="Add to Cart" href="product_details.php?id='.mysql_result($product,$i,"id").'">Buy<span class="icon"></span></a>
															</div>
														</div>
													</div>
												</li>';
											}
										echo '</ul>';
										}
									echo '</div>';
								echo '</div>
							</div>
					</div>';
						?>
				<!--end-of-new-arrivals-->
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<!-- banner -->
			
            <!-- ./banner -->
            <!-- ./popular cat -->
			<div class="col-sm-8 col-md-12 col-lg-2">
           
				<div style="margin-top:10px;" class="products kt-owl-carousel" data-margin="20" data-loop="true" data-nav="true" data-responsive='{"0":{"items":1},"600":{"items":4},"768":{"items":2},"1000":{"items":4},"1200":{"items":4}}'>					
					<?php
					$popularcate=mysql_query("SELECT * FROM ais_popular_cate")or die(mysql_error());
					if(mysql_num_rows($popularcate)>=1)
					{
						while($popurow=mysql_fetch_array($popularcate))
						{
							echo '<div class="page-banner">
									<ul class="list-banner">
										<li><a href="#"><img style="height:120px;" src="login/popular_category/'.$popurow['image'].'"></a></li>
									</ul>
									
								</div>';
								
						}
					}
					?>
				</div>
			</div>
			<!----POPULAR CATEGORY--->
		</div>
	</div>
	<!-- footer -->
	<footer id="footer">
		<div class="footer-social">
			<div class="container">
				<div class="row">
					<div class="block-social">
						<ul class="list-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
							<li><a href="#"><i class="fa fa-pied-piper"></i></a></li>
							<li><a href="#"><i class="fa fa-skype"></i></a></li>
						</ul>
					</div>
					<div class="block-payment">
						<ul class="list-logo">
							<li><a href="#"><img src="setting/data/payment1.png" alt="Payment Logo"></a></li>
							<li><a href="#"><img src="setting/data/payment2.png" alt="Payment Logo"></a></li>
							<li><a href="#"><img src="setting/data/payment3.png" alt="Payment Logo"></a></li>
							<li><a href="#"><img src="setting/data/payment4.png" alt="Payment Logo"></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="block-coppyright">
						Copyright &copy; <?php echo date('Y').' '.$companytitle['company_name'];?>. All Rights Reserved.
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- ./footer -->
	<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
	<script type="text/javascript" src="setting/assets/lib/jquery/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="setting/assets/lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="setting/assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="setting/assets/lib/owl.carousel/owl.carousel.min.js"></script>
	<script type="text/javascript" src="setting/assets/lib/jquery-ui/jquery-ui.min.js"></script>
	<!-- COUNTDOWN -->
	<script type="text/javascript" src="setting/assets/lib/countdown/jquery.plugin.js"></script>
	<script type="text/javascript" src="setting/assets/lib/countdown/jquery.countdown.js"></script>
	<!-- ./COUNTDOWN -->
	<script type="text/javascript" src="setting/assets/js/jquery.actual.min.js"></script>
	<script type="text/javascript" src="setting/assets/js/script.js"></script>
</body>
</html>