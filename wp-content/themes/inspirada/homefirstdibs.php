<?php /* Template Name: home first dibs */ ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php wp_title( '&laquo;', true, 'right'); ?>
        <?php bloginfo( 'name'); ?>
    </title>
    <link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/fancybox.css">
    <link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/all.css">
    <link media="all" rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/jcf.css">

    <!--	<script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/jquery-1.8.3.min.js"></script>
	[if IE]><script type="text/javascript" src="js/ie.js"></script><![endif]-->
    <!--[if lt IE 9]><link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/ie.css" media="screen"/><![endif]-->
    <script type="text/javascript" src="<?php bloginfo('template_url') ?>/js/modernizr.js"></script>
    <?php wp_head() ?>
    <style>
        .intro-section {
            max-width: 875px;
            padding: 0px 20px 91px !important;
            font-size: 16px;
            line-height: 29px;
            color: #fff;
            overflow: hidden;
            margin: 0 auto;
            text-shadow: 0 0 10px rgba(0,0,0, 0.72);
            margin-top: 40px !important;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <?php get_header() ?>
        <div class="w1">
            <div id="bg">
                <img src="<?php bloginfo('template_url') ?>/images/dark-greenbg.jpg">
            </div>
            <div class="intro-section" style="height: 500px; max-width: 1200px;">

 <div class="row">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="width: 120%;">
  
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" style="overflow: visible;">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-4" style="" id="saturday">
                            <div style="background-image: url(<?php bloginfo('template_url') ?>/images/blue-ribbon.png); background-size: 170px 100px; background-position: 0px 90px; text-align: center; width: 170px; height: 90px; display: block; margin: auto;">
                                        <a href="/super-saturday" style="color: white; text-decoration: none; font-family: 'roboto_slabregular', 'Times New Roman', Times, serif; font-size: 16px; display: block; padding-top: 15px; width: 80px; margin: auto; line-height: 20px;">REGISTER NOW</a>
                            </div>
                            <div style="text-align: center; width: 100%;">
                                <h2 style="font-size: 42px; font-weight: bold; line-height: 0px;">SUPER</h2>
                                <h2 style="font-size: 34px; line-height: 35px;">SATURDAY@</h2>
                                <img src="<?php bloginfo('template_url') ?>/images/INSP_LOGO_sat.png" style="width: 100%; margin: -15px 0 0 -20px;">
                                <h2 style="font-size: 35px; line-height: 0px; vertical-align: top; padding: 0; margin: 25px 0 0 0;">OCTOBER <span style="font-size: 35px;">4</span><sup>TH</sup></h2>
                                <p style="text-align: center; line-height: 22px; margin-top: 40px;"><span style="color: #f7d93e;">GRAND OPENING<br>
                                OF 2 NEW PARKS!</span><br>
                                TOUR 18 NEW<br>
                                HOME MODELS!<br>
                                <span style="color: #f7d93e;">GREAT FOOD</span><br>
                                FAMILY FUN<br>
                                <span style="color: #f7d93e;">SPORTS CLINICS</span><br>
                                PET ADOPTION</p>
                            </div>
                                </div>
                                <div class="col-sm-6" style="display: inline-block; float: none;" id="saturday-video">
                                    <iframe style="" src="//www.youtube.com/embed/aZCddvpFjYQ" frameborder="0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <section class="start-section add">
        <div class="holder" style=" padding-top: 25px; padding-bottom: 25px; ">
            <h1 style="margin-bottom: 15px;"><span>Download our new APP!</span></h1>
            <div class="row">
                <div class="col-sm-6">
                    <img class="image" src="<?php bloginfo('template_url') ?>/images/arapp.png" alt="image description">
                </div>
                <div class="col-sm-6" <div class="text-box" style="color: white;">
                    <p>With new neighborhoods, parks and trails, we wanted you to see Inspirada as it grows - <strong>with the new Inspirada app!</strong>

                        <p style="margin-bottom: 0px;">The specially designed technology lets you experience the Inspirada Vision at completion!</p>
                        </br>
                        <a href="http://166.78.0.133/wp-content/uploads/2014/07/appstore.png">
                            <img style="
margin-bottom: 15px;
margin-right: 15px;" class="alignnone size-full wp-image-2005" src="http://166.78.0.133/wp-content/uploads/2014/07/appstore.png" alt="appstore" width="179" height="60" />
                        </a>
                        <a href="http://166.78.0.133/wp-content/uploads/2014/07/googplay.png">
                            <img style="margin-bottom: 15px;" class="alignnone size-full wp-image-2006" src="http://166.78.0.133/wp-content/uploads/2014/07/googplay.png" alt="googplay" width="179" height="60" />
                        </a>
                        </br>
                        <h1 style="text-transform: none; font-size: 28px; text-align: left; margin-bottom: 10px;">It's free and it takes only seconds!</h1>
                        <p>Add the app to your iPhone or Android smartphone tablet or mobile device. Then, direct your device in the direction of Inspirada.</p>

                        Only Inspirada offers an app that brings the virtual future to you.
                        <h1 style="text-transform: none; font-size: 28px; text-align: left; margin-bottom: 10px;">Now that's Living Inspired</h1>
                </div>
            </div>
        </div>
    </section>
    </div>
    <?php get_footer() ?>
    <?php wp_footer() ?>
</body>

</html>