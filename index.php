<?php get_header(); ?>
<?php get_sidebar( 'left' ); ?>
<div id='indexpage'>
    <?php //configuracion de la petición actual
    if(isset($_GET['s'])){
        $busqueda = $_GET['s'];
        $configuracionEspecifica = 'search="' . $busqueda . '"';
        echo '<h1>Resultados de búsqueda <i>' . $busqueda . '</i></h1>';
    } else if (is_category()) { //TODO: categorías con tildes?? no recupera nada
        $cur_cat_id = get_cat_ID( single_cat_title("", false) ); 
        $category = get_cat_name($cur_cat_id);
        $configuracionEspecifica = 'category="' . $category . '"';
        echo '<h1>Categoría <i>' . $category . '</i></h1>';
    } else if (is_author()) {
        $author = get_the_author_meta('ID');
        $configuracionEspecifica = 'author="' . $author . '"';
        echo '<h1>Autor <i>' . $author . '</i></h1>';
    } else if (is_category()) {
        $tag = get_query_var('tag');
        $configuracionEspecifica = 'tag="' . $tag . '"';
        echo '<h1>Etiqueta <i>' . $tag . '</i></h1>';
    } else {
        $configuracionEspecifica = '';
    }
    ?>
    
    <?php //carga inicial ?>
    <?php if (have_posts()) : ?>
        <?php //echo do_shortcode('[ajax_load_more]'); ?>
        <?php while (have_posts()) : the_post(); ?>
        <?php include('entry.php'); ?>
        <?php endwhile; ?>
    <?php else : ?>
        <div class="post">
            <div class='heading'>No encontrado</div>
            <br/>
            <div class='entry' style="display: block;">
                Lo siento, no encuentro lo que buscas :(
                <br/>
                <br/>
            </div>
        </div>
    <?php endif; ?>

    
    <?php //carga ajax
    $postsIniciales = get_option('posts_per_page');
    $configuracionComun = 'ajax_load_more posts_per_page="10" post_type="post" max_pages="1000" button_label="Cargar más" offset="' . $postsIniciales . '"';

    echo do_shortcode('[' . $configuracionComun . ' ' . $configuracionEspecifica . ']'); 
    ?>
</div>

<!--div class="navigation">
    <?php //previous_posts_link("<span style='float: right;'>Publicaciones más recientes &raquo;</span>"); ?>
    <?php //next_posts_link("<span>&laquo; Publicaciones anteriores</span>"); ?>
    <div class='divclear'></div>
</div-->

<?php global $options; if( $options['expandfirst'] == 1 ) : ?>

    <script>
        showIndexPost.call($('#indexpage > .post:first .posttitlebar'));
    </script>

<?php endif; ?>

<?php get_footer(); ?>

