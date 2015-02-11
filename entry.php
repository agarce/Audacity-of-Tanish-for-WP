<div class="post" id="post-<?php the_ID(); ?>">

    <div class='posttitlebar' onclick="showIndexPostFalsa(); ">

        <div class='dateauthor'>
            <?php the_time('j-M-Y'); ?><?php //the_author(); ?>
        </div>

        <div class='heading'>
            <?php $title = get_the_title() or $title = "(sin título)"; print $title; ?>
        </div>

    </div>

    <?php
        if(function_exists('get_avatar'))
            echo get_avatar(get_the_author_id(), '50');
    ?>

    <div class='postmetabox'>

        <div class='postmetabutton'>
            <img
                src='<?php print get_bloginfo('template_url') . "/images/info.png"; ?>'
                alt='Info'
                title='Información del post' />
        </div>

        <div class='postmetadata'>
            <?php edit_post_link('Editar entrada', '<div>', '</div>'); ?>
            <div>
                <a href="<?php the_permalink() ?>" rel="bookmark"
                    title="Link permanente a <?php the_title(); ?>">Enlace del post</a>
            </div>
            <?php if( ! is_single() ): ?>
            <div>
                <?php comments_popup_link('Sin comentarios', '1 comentario', '% Comments'); ?>
            </div>
            <?php endif; ?>

            <?php if( get_the_category() ) : ?>
                <div id='postcats-<?php the_ID(); ?>' class='postcats'>
                    <strong>Categorías:</strong>
                    <ul>
                    <?php
                        foreach((get_the_category()) as $cat)
                        {
                            print
                                "<li><a href='" . get_category_link($cat->cat_ID) . "'>" .
                                "$cat->cat_name</a></li>";
                        }
                    ?>
                    </ul>
                    <br />
                </div>
            <?php endif; ?>

            <?php if( get_the_tags() ) : ?>
                <div id='posttags-<?php the_ID(); ?>' class='posttags'>
                    <strong>Etiquetas:</strong>
                    <ul>
                    <?php
                        print
                            get_the_tag_list(
                                    $before = '<li>',
                                    $sep = '</li><li>',
                                    $after = '</li>');
                    ?> 
                    </ul>
                    <br />
                </div>
            <?php endif; ?>

        </div> <!-- end postmeta -->

    </div> <!-- end postmetabox -->

    <div class='entry'>

        <?php 
        /*
                //CrayonSyntax.init();
                //$crayon = CrayonWP::instance();
                //$crayon.highlight(the_content('', FALSE, '')); 
                require_once(ABSPATH . 'wp-content/plugins/crayon-syntax-highlighter/' . 'crayon_settings_wp.class.php');

                CrayonWP::init(); //CrayonSyntax.init(); 
                CrayonSettingsWP::load_settings(TRUE);
                //$crayon = CrayonWP::instance();
                //$crayon.init();

                //CrayonWP::the_content(the_content('', FALSE, ''));
                //CrayonWP::highlight(the_content('', FALSE, ''));

        */
            if (is_singular()) {
                the_content('', FALSE, '');
            } else {
                the_excerpt();
            }
        ?>

        <a
                class='morelink'
                title='Leer publicación completa y comentarios'
                href='<?php the_permalink(); ?>'>Leer publicación completa y comentarios »</a>

        <br />

    </div> <!-- entry -->

</div> <!-- post -->

<!--br  /-->