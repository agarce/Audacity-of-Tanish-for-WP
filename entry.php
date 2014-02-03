
<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <div class="post" id="post-<?php the_ID(); ?>">

            <div class='posttitlebar'>

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
                        title='View Post Info' />
                </div>

                <div class='postmetadata'>

                    <div>
                        <ul>
                            <li>
                                <a href="<?php the_permalink() ?>" rel="bookmark"
                                    title="Link permanente a <?php the_title(); ?>">Permalink</a>
                            </li>
                        </ul>
                    </div>

                    <?php edit_post_link('Editar entrada', '<div><ul><li>', '</li></ul></div>'); ?>

                    <?php if( ! is_single() ): ?>
                    <div>
                        <li>
                            <?php comments_popup_link('Sin comentarios', '1 comentario', '% Comments'); ?>
                        </li>
                    </div>
                    <?php endif; ?>

                    <?php if( get_the_category() ) : ?>
                        <div id='postcats-<?php the_ID(); ?>' class='postcats'>
                            <h4>Categorías</h4>
                            <?php
                                foreach((get_the_category()) as $cat)
                                {
                                    print
                                        "<a href='" . get_category_link($cat->cat_ID) . "'>&raquo; " .
                                        "$cat->cat_name</a><br />";
                                }
                            ?>
                            <br clear='all' />
                        </div>
                    <?php endif; ?>

                    <?php if( get_the_tags() ) : ?>
                        <div id='posttags-<?php the_ID(); ?>' class='posttags'>
                            <h4>Tags</h4>
                            <?php
                                print
                                    get_the_tag_list(
                                            $before = '&raquo; ',
                                            $sep = '<br />&raquo; ',
                                            $after = '');
                            ?> 
                            <br clear='all' />
                        </div>
                    <?php endif; ?>

                </div> <!-- end postmeta -->

            </div> <!-- end postmetabox -->

            <div class='entry'>

                <?php the_content('', FALSE, ''); ?>

                <a
                        class='morelink'
                        title='Leer publicación completa y comentarios'
                        href='<?php the_permalink(); ?>'>Leer publicación completa y comentarios &raquo;</a>

                <br clear='all' />

            </div> <!-- entry -->

        </div> <!-- post -->

    <?php endwhile; ?>

<?php else : ?>

    <div class="post">
        <div class='heading'>No encontrado</div>
            <br/>
            <div class='entry'>
                Lo sentimos, pero estás buscando algo que (ya) no se encuentra en esta dirección.
                <br/>
                <br/>
            </div>
        </div>
    </div>

<?php endif; ?>

<br clear='all' />

