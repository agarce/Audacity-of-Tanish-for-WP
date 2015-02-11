<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta
        http-equiv="Content-Type"
        content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"
    />

    <title><?php bloginfo('name'); ?> - <?php wp_title(); ?></title>
    
    <link rel="alternate" type="application/rss+xml"
        title="<?php bloginfo('name'); ?> RSS Feed"
        href="<?php bloginfo('rss2_url'); ?>"
    />
    <link rel="pingback" 
          href="<?php bloginfo('pingback_url'); ?>" 
    />
    
    <link rel="stylesheet" type="text/css" media="screen" 
        href="<?php bloginfo('stylesheet_url'); ?>"
    />
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"  />
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' />
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Roboto+Condensed' />
    <?php
        if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
        wp_head();
    ?>

    

    <!-- load shortcode handlers -->
    <?php //include_once("shortcodes.php"); ?>

    <!-- set backgrounds, credits, etc based on user preference -->
    <style type='text/css'>

        <?php print bg_images_css("#bgtilediv", 'mainbgtile', 'bgtile', "repeat top left"); ?>
        <?php print bg_images_css("#container", 'mainbgimage', 'bgimage', "no-repeat 80% 0%"); ?>

    </style>
    <?php
        // Load custom stylesheet
        if( file_exists(TEMPLATEPATH . "/custom.css") )
        {
            $customstylesheet = get_bloginfo('template_url') . "/custom.css";
            print "<link rel='stylesheet' href='$customstylesheet' type='text/css' media='screen'>\n";
        }
    ?>
    <script type="text/javascript" src="<?php print get_bloginfo('template_url').'/jquery-min.js'; ?>"></script>
    <script type="text/javascript" src="<?php print get_bloginfo('template_url').'/tanish.js'; ?>"></script>
    <?php print comments_hide_html(); ?>
</head>

<body>

<?php if( $options['iewarn'] == 1 ) : ?>
    <div id='upgrademsie'>
        <a href='http://apple.com/safari/'>
        <img
            border=0
            src="<?php print get_bloginfo('template_url').'/images/navSafari.png'; ?>"
            alt='Safari'
            title='Safari'
        />
        </a>
        <a href='http://getfirefox.com/'>
        <img
            border=0
            src="<?php print get_bloginfo('template_url').'/images/navFirefox.png'; ?>"
            alt='Firefox'
            title='Firefox'
        />
        </a>
        <a href='http://apple.com/safari/'>
        <img
            border=0
            src="<?php print get_bloginfo('template_url').'/images/navChrome.png'; ?>"
            alt='Chrome'
            title='Chrome'
        />
        </a>
        You are using Internet Explorer. Have you considered upgrading?
        <br />
    </div>
<?php endif; ?>

<!--
    without this extra wrapper div, setting background seems impossible. Setting
    background for BODY causes incomplete tiling at the bottom when a post title
    is clicked and the post expands down.
-->

<div id='bgtilediv'>
<div id='container'>

    <!--div id='rsslink'>
        <a href='<?php //bloginfo("rss2_url"); ?>'>
        <img border='0' align='top' alt='Site RSS'
            src='<?php //print get_bloginfo('template_directory') . "/images/rssgreen.png"; ?>'>
        </a>
    </div-->
    <div id='search'>
        <?php get_search_form( true ); ?>
    </div>
    
    <div id='header'>
        <div id='title' class='heading'>
            <a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a>
        </div>
        <div id='description'> <?php bloginfo('description'); ?></div>
        <br />
    </div>
    
    
