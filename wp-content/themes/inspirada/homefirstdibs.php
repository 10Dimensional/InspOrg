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
</head>

<body>
    <div id="wrapper">
        <?php get_header() ?>
        <div class="w1">
            <div id="bg">
                <img src="<?php bloginfo('template_url') ?>/images/greenbg.jpg">
            </div>
            <div class="intro-section">

 <div class="row">
                                <div class="col-xs-12">
                                    <img src="<?php bloginfo('template_url') ?>/images/eventheadlineribbon.png">
                                </div>
                            </div>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="width: 120%;">
  
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" style="overflow: visible;">
                        <div class="item active">
                   
                            <div class="row">
                                <div class="col-sm-3">
                                    <img src="<?php bloginfo('template_url') ?>/images/house1.png">
                                </div>
                                <div class="col-sm-4">
                                    <p>
                                        <?php echo $post->post_content ?></p>
                                    <a href="/first-dibs">
                                        <div class="register-now"></div>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <img class="mobile-hide" src="<?php bloginfo('template_url') ?>/images/house2.png">
                                </div>
                            </div>

                        </div>
                    <div class="item">
                        <div class="row">
                            <div class="col-sm-8">
                                <p>
                                    <?php the_field('slide_2_text'); ?></p>
                                <a href="/first-dibs">
                                    <div class="register-now"></div>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <img class="mobile-hide" src="<?php bloginfo('template_url') ?>/images/house3.png">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                       
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    <?php the_field('slide_3_text'); ?></p>
                                <a href="/first-dibs">
                                    <div class="register-now"></div>
                                </a>
                            </div>
                            <div class="col-sm-4">
                                <img class="mobile-hide" src="<?php bloginfo('template_url') ?>/images/house4.png">
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