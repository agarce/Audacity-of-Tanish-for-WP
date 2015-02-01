
$(document).ready
(
    function()
    {
        // IE specific hacks to deal with the fact that if you have any floating element
        // inside another, then the inside one's width is set to 100%!
        if( $.browser.msie )
        {
            $('#indexpage .postmetabutton').css('float', 'none');

            // a few other things while we are at it
            $('#comments').css('margin-top', '120px');

            $('#upgrademsie').fadeIn('slow');
            setTimeout(function() { $('#upgrademsie').fadeOut('slow'); }, 8000);

            $('.postmetadata DIV:last-child').css('border-bottom', 'none');
            $('.entry UL LI:last-child, .entry OL LI:last-child').css('border-bottom', 'none');
        }

        //$('#indexpage .posttitlebar').click(showIndexPost);
        //$('#indexpage .postmetabutton').click(togglePostMeta);

        $('.posttitlebar').live('click', showIndexPost);
        $('.postmetabutton').live('click', togglePostMeta);


        $('.sbtitle').click(toggleSBList);
        $('#leftbarbox > .sbtoggle').click(toggleSBleft);
        //$('#bottombarbox').mouseover(function() { $(this).find('.bottombar').show(); });
        //$('#bottombarbox').mouseout(function() { $(this).find('.bottombar').hide(); });

        $('#single .postmetadata').fadeTo('slow', 0.4);
        $('#single .postmetadata').mouseenter( function() { $(this).fadeTo('fast', 1.0); } );
        $('#single .postmetadata').mouseleave( function() { $(this).fadeTo('slow', 0.4); } );

        $('#indexpage').fadeIn('slow');
        $('#single').fadeIn('slow');
        $('#single .entry').fadeIn(2000);
    }
);
 
function showIndexPostFalsa() {
    showIndexPost($(this));
}

function showIndexPost()
{
    var curstatus = $(this).parent().find('.entry').css('display');

    // TODO: all these close down actions are performed gratuitously for all
    // elements, whereas they can be done just for class .postselected --
    // should that be an id not a class? -- saving some jQuery CPU usage
    $('.entry').slideUp();
    $('.postmetabox').hide();   // hide the (I) icon by hiding the postmetabox
    $('.postmetadata').hide();
    $('.post').removeClass('postselected');
    $('#indexpage .post').css('opacity', '1.0');

    if( curstatus != 'block' )
    {
        $(this).parent().addClass('postselected');
        $(this).parent().find('.entry').slideDown('slow');
        $(this).parent().find('.postmetabox').show('slow');
        $('#indexpage .post').filter(":not(.postselected)").css('opacity', '0.7');
    }
}


function togglePostMeta()
{
    var curstatus = $(this).parent().parent().find('.postmetadata').css('display');
    $('.clearpostmetafloat').hide();
    if( curstatus != 'block' )
    {
        $(this).parent().parent().find('.clearpostmetafloat').show();
        $(this).parent().find('.postmetadata').fadeIn('slow');
    }
    else
        $(this).parent().find('.postmetadata').fadeOut('slow');
}


function toggleSBList()
{
    var contenido = $(this).parent().find('.sbcontent');
    var curstatus = contenido.css('display');

    if( curstatus == 'none' )
    {
        contenido.slideDown('slow');
    } else {
        contenido.slideUp();
    }
}
function toggleSBleft()
{
    var curstatus = $(this).parent().find('.leftbar').css('display');
    
    if( curstatus == 'none' )
    {
        $(this).parent().removeClass('leftbarbox-hidden'); //find('#leftbarbox')
        $('#indexpage').addClass('leftbarbox-visible');
        $('#single').addClass('leftbarbox-visible');
    } else {
        $(this).parent().addClass('leftbarbox-hidden'); //.find('#leftbarbox')
        $('#indexpage').removeClass('leftbarbox-visible');
        $('#single').removeClass('leftbarbox-visible');
    }
}