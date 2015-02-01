
<div id='leftbarbox' class="leftbarbox-hidden">
    <p class="sbtoggle"><i class="fa fa-ellipsis-v"></i></p> <!-- fa-ellipsis-v fa-chevron-right -->
    <div class='leftbar'>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('leftbartop') ) : ?>
        <?php endif; ?>
    </div> <!-- end leftbar top -->

    <div class='leftbar'>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('leftbarcenter') ) : ?>
        <?php endif; ?>
    </div>

    <div class='leftbar'>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('leftbarbottom') ) : ?>
        <?php endif; ?>
    </div>
 
    <!--br clear='all' /-->

</div>

