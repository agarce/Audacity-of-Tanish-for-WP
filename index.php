<?php get_header(); ?>

<div id='indexpage'>
    <?php include("entry.php"); ?>
</div>

<div class="navigation">
    <?php previous_posts_link("<span style='float: right;'>Publicaciones más recientes &raquo;</span>"); ?>
    <?php next_posts_link("<span>&laquo; Publicaciones anteriores</span>"); ?>
    <div class='divclear'></div>
</div>

<?php global $options; if( $options['expandfirst'] == 1 ) : ?>

    <script language='JavaScript'>

        showIndexPost.call($('#indexpage > .post:first .post-title-bar'));

    </script>

<?php endif; ?>

<?php get_footer(); ?>

