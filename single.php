<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<div id='single'>

    <?php 
        global $singlePost;
        $singlePost = 1;
        the_post();
        include('entry.php'); 
    ?>

    <?php
        wp_link_pages(
                array
                (
                    'before' => '<div id="subpagelinks"><span>Páginas:</span> ',
                    'after' => '</div>',
                    'next_or_number' => 'number'
                )
        );
    ?>

</div>

<?php comments_template(); ?>

<?php get_footer(); ?>

