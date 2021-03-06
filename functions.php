<?php
//Aplicar Crayon Syntax utilizando llamadas AJAX (plugin ajax-load-more)
add_filter('the_content', 'add_crayons_to_content');
global $singlePost;
$singlePost = 0;
function add_crayons_to_content($content) {
    /*
	global $post;
	$id = $post->ID;
	// Generate some code based on post ID etc
	$some_code = "<strong>hello world</strong>";
	$crayon = '<pre class="lang:html toolbar:always mark:1">' . $some_code . '</pre>';
	// Add Crayon to content
    */
        global $singlePost;
        if ($singlePost != 1) { //no hacer la llamada en single-post
            $jsCrayon = '<script type="text/javascript">
                    CrayonUtil.init();
                    CrayonSyntax.init();
                    CrayonSyntax.process(CrayonSyntax);    
                </script>';
            return CrayonWP::highlight($content) . $jsCrayon;
        } else {
            return $content;
        }
	

}

if( ! is_array(get_option('tanish')) )
    add_option('tanish', array('init' => 1));

$options = get_option('tanish');

# defaults
if( ! isset($options['showauthors' ]) ) $options['showauthors' ] = 0;
if( ! isset($options['expandfirst' ]) ) $options['expandfirst '] = 0;
if( ! isset($options['showcredits' ]) ) $options['showcredits '] = 1;
if( ! isset($options['hidecomments']) ) $options['hidecomments'] = 0;
if( ! isset($options['mainbgimage' ]) ) $options['mainbgimage '] = 'None';
if( ! isset($options['mainbgtile'  ]) ) $options['mainbgtile ' ] = 'None';
if( ! isset($options['iewarn'      ]) ) $options['iewarn'      ] = 0;
# end defaults

update_option('tanish', $options);

# setup admin menu
add_action('admin_menu', 'tanish_admin_menu');



//Añadir soporte HTML5 para mejorar el formulario de búsqueda
function custom_theme_setup() {
    add_theme_support( 'html5', array( 'search-form' ) );
}
add_action( 'after_setup_theme', 'custom_theme_setup' );



if ( function_exists('register_sidebar') )
    add_sidebars();


//-------------------------------------------------------------------------------
function tanish_admin_menu()
{
    add_theme_page('Tanish Options', 'Tanish Options', 'edit_themes', "Audacity of Tanish", 'tanish_options');
}

//-------------------------------------------------------------------------------
function tanish_options()
{
    global $options;

    if( $_POST['action'] == 'save' )
        save_options();

    print options_followinfo();

    print
    "
        <form id='settings' action='' method='post' class='themeform'
            style='margin: 20px;'>

            <h3>Customise this Theme</h3>

            Want to customise this theme? Don't edit the stylesheets or PHP files
            of this theme using the Theme Editor. Why not? Because when you use
            the WP upgrade mechanism to upgrade this theme, it blows away all your
            changes. The/One right way to customise themes is to create a 'child
            theme' -- that will be a feature available in an upcoming release of
            this theme. In the meantime, if you want to do the manual work, please
            <a href='http://ahren.org/code/contact'>contact me</a> for
            instructions.

            <h3>General</h3>

            <input type='hidden' id='action' name='action' value='save'>

            <input type='checkbox' name='showauthors' id='showauthors'" .
                ($options['showauthors'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='showauthors'>Show Authors in Sidebar</label>

            <br />

            <input type='checkbox' name='expandfirst' id='expandfirst'" .
                ($options['expandfirst'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='expandfirst'>
                In home page (posts mode) expand top most (latest) post
            </label>

            <br />

            <input type='checkbox' name='showcredits' id='showcredits'" .
                ($options['showcredits'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='showcredits'>
                Show credits at the bottom
            </label>

            <br />

            <input type='checkbox' name='hidecomments' id='hidecomments'" .
                ($options['hidecomments'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='hidecomments'>
                Make comments collapsible/expandable on posts/pages
            </label>

            <br />

            <input type='checkbox' name='iewarn' id='iewarn'" .
                ($options['iewarn'] == 1 ? ' checked' : '') . " />
            <label style='margin-left: 5px;' for='iewarn'>
                Offer helpful upgrade suggestions to Internet Explorer users ;-)
            </label>

            <br/>
            <br/>

            <h3>Background Images</h3>

            <label for='mainbgtile'>Choose background (tile):</label><br />

    "
        . images_dir_html("bgtile", 4, 'mainbgtile') .
    "
            <label for='mainbgimage'>Choose background image:</label><br />
    "
        . images_dir_html("bgimage", 4, 'mainbgimage') .
    "
            </div>
            <br />
            <br/>
            <hr size='1'/>

            <p class='submit'><input type='submit' value='Save Changes' name='save'/></p>

        </form>

        <div style='
            width: 60%;
            margin: 30px 0px;
            background-color: #cceeff;
            border: 1px solid #88bbcc;
            padding: 30px;'
        >
            All graphics and libraries (jQuery and derivatives)
            used in this theme are released by their respective authors as
            either free (for unlimited free or commercial use, without
            need for attribution), or under the GPL. Many thanks are owed to
            them for their contribution to the public domain.

            <br/>

        </div>
    ";
}

//------------------------------------------------------------------------------
function options_followinfo()
{
    return("
        <div style=
                '
                    clear: right;
                    float: right;
                    margin: 10px 10px 10px 20px;
                    background-color: #fff3cc;
                    color: #000000;
                    padding: 10px 15px;
                    border: 2px solid #ddc055; width: 25%;
                    width: 150px;
                '
        >
            <h3>Keep up with Audacity of Tanish</h3>

            <p>
                Follow on Twitter, or join the Facebook Page. Subscribe to the blog.
                Create bug/feature requests, download the latest code, and more!
            </p>

            <ul>
            <li style='list-style-type: circle; margin-left: 10px;'>
                Blog:
                <ul>
                <li><a href='http://ahren.org/code/tag/tanish-wp'>Audacity of Tanish</a></li>
                <li><a href='http://ahren.org/code/'>Ahren Code</a></li>
                </ul>
            </li>
            <li style='list-style-type: circle; margin-left: 10px;'>
                Twitter:
                <ul>
                <li><a href='http://search.twitter.com/search?q=%23tanish-wp'>Audacity of Tanish</a></li>
                <li><a href='http://twitter.com/ahrencode/'>Ahren Code</a></li>
                </ul>
            </li>
            <li style='list-style-type: circle;  margin-left: 10px;'>
                <a
                href='http://www.facebook.com/home.php#/pages/Ahren-Code/64305786260'>Facebook</a>
            </li>
            <li style='list-style-type: circle;  margin-left: 10px;'>
                <a href='http://github.com/ahrencode/Audacity-of-Tanish-for-WP/issues'>
                    Changes, Bugs and Features</a>
            </li>
            </ul>
        </div>
    ");
}

//------------------------------------------------------------------------------
function images_dir_html($dir, $count, $fldname)
{
    global $options;

    $html =
    "
        <br/>

        <div style=
            '
                float: left;
                padding: 15px;
                background-color: #eeeeee;
                color: #000000;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
            '
        >
    ";

    $ctr = $count - 2;
    foreach( array_merge(array("None", "Random"), scandir(TEMPLATEPATH . "/images/" . $dir)) as $image )
    {
        if( $image == '.' || $image == '..' )
            continue;

        if( $ctr > 0 && ($ctr % $count) == 0 )
            $html .= "<br /><br />\n";

        $ctr++;

        $checked = "";
        if( $options[$fldname] == $image )
            $checked = "checked";

        $html .= "<input type='radio' name='$fldname' id='$fldname$ctr' value='$image' $checked>";

        if( $image == "None" || $image == "Random" )
            $html .= $image;
        else
            $html .=
            "
                <label for='$fldname$ctr'>
                    <img alt='$image' title='$image' height='64' width='64' align='middle'
                        src='" . get_bloginfo('template_directory') . "/images/$dir/$image' />
                </label>
            ";

        $html .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    }

    $html .=
    "
        </div>
        <br clear='left' />
        <br />
    ";

    return($html);
}

//------------------------------------------------------------------------------
function comments_hide_html()
{
    global $options;

    if( $options['hidecomments'] != 1 )
        return;

    // Could check for is_single() or some such here but do we really
    // save much by doing so? The logic is safe even without the check
    // since the jQuery will fire only for #single.
    print
    "
        <style type='text/css'>

            #commentsheader
            {
                cursor: pointer;
            }

            #commentscontainer
            {
                display: none;
            }

        </style>

        <script>
            $(document).ready
            (
                function()
                {
                    $('#commentsheader').click(function() { $('#commentscontainer').toggle(500); });
                }
            );
        </script>
    ";
}

//------------------------------------------------------------------------------
function bg_images_css($selector, $optname, $imgdir, $pos_repeat)
{
    global $options;

    $image = $options[$optname];

    if( $image == 'None' )
        return;

    if( $image == "Random" )
    {
        $images = preg_grep("/^\./", scandir(TEMPLATEPATH . "/images/" . $imgdir), PREG_GREP_INVERT);
        $randidx = rand(2, sizeof($images)-1);
        $image = $images[$randidx];
    }

    // the v=$randidx below is because Firefox refuses to reload a background image
    // unless the URL has changed.
    return
    ("
        $selector
        {
            background: url(" . get_bloginfo('template_url') .
                            "/images/$imgdir/$image?v=$randidx) $pos_repeat;
        }
    ");
}

//------------------------------------------------------------------------------
function save_options()
{
    global $_POST, $options;

    $options['showauthors' ]    = ( isset($_POST['showauthors' ]) ) ? 1 : 0;
    $options['expandfirst' ]    = ( isset($_POST['expandfirst' ]) ) ? 1 : 0;
    $options['showcredits' ]    = ( isset($_POST['showcredits' ]) ) ? 1 : 0;
    $options['hidecomments']    = ( isset($_POST['hidecomments']) ) ? 1 : 0;
    $options['iewarn'      ]    = ( isset($_POST['iewarn'      ]) ) ? 1 : 0;
    $options['mainbgimage' ]    = ( isset($_POST['mainbgimage' ]) ) ? $_POST['mainbgimage'] : "None";
    $options['mainbgtile'  ]    = ( isset($_POST['mainbgtile'  ]) ) ? $_POST['mainbgtile' ] : "None";

    update_option('tanish', $options);

    print
    "
        <div class='updated fade' id='message'
            style='background-color: rgb(255, 251, 204);
                    width: 300px;
                    margin-top: 30px;
                    margin-left: 20px'>
            <p>Tanish Settings <strong>saved</strong>.</p>
        </div>
    ";
}

//------------------------------------------------------------------------------
function add_sidebars()
{
    //Bottom Bar
    
    register_sidebar(array(
        'name' => 'bottombarleft',
        'before_widget' => "<div class='sidebarlist'>",
        'before_title' => "<p class='sbtitle'>" .
                            "<img alt='' height='10' src='" .
                                get_bloginfo('template_directory') .
                                "/images/down.png' /> ",
        'after_title' => "</p><div class='sbcontent'>",
        'after_widget' => "</div></div>",
    ));

    register_sidebar(array(
        'name' => 'bottombarcenter',
        'before_widget' => "<div class='sidebarlist'>",
        'before_title' => "<p class='sbtitle'>" .
                            "<img alt='' height='10' src='" .
                                get_bloginfo('template_directory') .
                                "/images/down.png' /> ",
        'after_title' => "</p><div class='sbcontent'>",
        'after_widget' => "</div></div>",
    ));

    register_sidebar(array(
        'name' => 'bottombarright',
        'before_widget' => "<div class='sidebarlist'>",
        'before_title' => "<p class='sbtitle'>" .
                            "<img alt='' height='10' src='" .
                                get_bloginfo('template_directory') .
                                "/images/down.png' /> ",
        'after_title' => "</p><div class='sbcontent'>",
        'after_widget' => "</div></div>",
    ));
    
    //Left Bar
    register_sidebar(array(
        'name' => 'leftbartop',
        'before_widget' => "<div class='sidebarlist'>",
        'before_title' => "<p class='sbtitle'>" .
                            "<img alt='' height='10' src='" .
                                get_bloginfo('template_directory') .
                                "/images/down.png' /> ",
        'after_title' => "</p><div class='sbcontent'>",
        'after_widget' => "</div></div>",
    ));

    register_sidebar(array(
        'name' => 'leftbarcenter',
        'before_widget' => "<div class='sidebarlist'>",
        'before_title' => "<p class='sbtitle'>" .
                            "<img alt='' height='10' src='" .
                                get_bloginfo('template_directory') .
                                "/images/down.png' /> ",
        'after_title' => "</p><div class='sbcontent'>",
        'after_widget' => "</div></div>",
    ));

    register_sidebar(array(
        'name' => 'leftbarbottom',
        'before_widget' => "<div class='sidebarlist'>",
        'before_title' => "<p class='sbtitle'>" .
                            "<img alt='' height='10' src='" .
                                get_bloginfo('template_directory') .
                                "/images/down.png' /> ",
        'after_title' => "</p><div class='sbcontent'>",
        'after_widget' => "</div></div>",
    ));
}

//------------------------------------------------------------------------------
function ac_admin_error($msg)
{
        print
        "
            <div
                style='background-color: #aa4400;
                        color: #ffffff;
                        border: 1px solid #660000;
                        padding: 3px 8px;
                        width: 300px;
                        margin-top: 30px;
                        margin-left: 20px'>
            $msg
            </div>
        ";
}




?>
