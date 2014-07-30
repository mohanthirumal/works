<?php
/**
 * Twenty Twelve functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Twelve supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_setup() {
	/*
	 * Makes Twenty Twelve available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Twelve, use a find and replace
	 * to change 'twentytwelve' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwelve', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'twentytwelve_setup' );

/**
 * Adds support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/*
	 * Adds JavaScript for handling the navigation menu hide-and-show behavior.
	 */
	wp_enqueue_script( 'twentytwelve-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

	/*
	 * Loads our special font CSS file.
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'twentytwelve-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */

	/* translators: If there are characters in your language that are not supported
	   by Open Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'twentytwelve' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate
		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'twentytwelve' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		//wp_enqueue_style( 'twentytwelve-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'twentytwelve-style', get_stylesheet_uri() );

	/*
	 * Loads the Internet Explorer specific stylesheet.
	 */
	wp_enqueue_style( 'twentytwelve-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentytwelve-style' ), '20121010' );
	$wp_styles->add_data( 'twentytwelve-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentytwelve_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Twenty Twelve 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function twentytwelve_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentytwelve_wp_title', 10, 2 );

/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'twentytwelve_page_menu_args' );

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentytwelve' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'twentytwelve' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentytwelve_widgets_init' );

if ( ! function_exists( 'twentytwelve_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentytwelve' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentytwelve' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}
endif;

if ( ! function_exists( 'twentytwelve_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentytwelve_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'twentytwelve_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentytwelve_entry_meta() to override in a child theme.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentytwelve' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentytwelve' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentytwelve' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'twentytwelve' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Twenty Twelve 1.0
 *
 * @param array Existing class values.
 * @return array Filtered class values.
 */
function twentytwelve_body_class( $classes ) {
	$background_color = get_background_color();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'twentytwelve-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'twentytwelve_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'twentytwelve_content_width' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since Twenty Twelve 1.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function twentytwelve_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentytwelve_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Twenty Twelve 1.0
 */
function twentytwelve_customize_preview_js() {
	wp_enqueue_script( 'twentytwelve-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );
}
add_action( 'customize_preview_init', 'twentytwelve_customize_preview_js' );
add_filter( 'show_admin_bar', '__return_false' );

function MyAjaxLogin(){
	checkAjaxCall();
	session_start();
	$creds = array();
	$creds['user_login'] = addslashes($_REQUEST['log']);
	$creds['user_password'] = addslashes($_REQUEST['pwd']);
	$creds['rem'] = $_REQUEST['remem'];
	$code = addslashes($_REQUEST['code']);
	$logCount = $_REQUEST['coun'];
	$ip = getRemoteAddr();
	$ip_address = $ip ? ip2long($ip) : '';
	$ip_host = @gethostbyaddr($ip);
	$sql = 'SELECT id FROM `user_verify` WHERE (ip_address = '.$ip_address.' OR username = \''.$creds['user_login'].'\')';
	$rowcount = mysql_num_rows(mysql_query($sql));
	$totalForm = array();
	parse_str($_POST['form'], $totalForm);
	if(isset($rowcount) && $rowcount > 1)
		if(strlen($totalForm["recaptcha_response_field"]) == 0)
		{
			$error['attempt'] = $rowcount;
			die(json_encode($error));
		}
		else
		{
			require_once(ABSPATH.'classes/recaptchalib.php');
			$privatekey = "6Ldgge0SAAAAAJMuVScV5osUNvLaQrnsw_ir3zXs";
			$resp = recaptcha_check_answer ($privatekey,
									$_SERVER["REMOTE_ADDR"],
									$totalForm["recaptcha_challenge_field"],
									$totalForm["recaptcha_response_field"]);
	  
			if(!$resp->is_valid && $logCount > 2)
			{
				$error['msg'] = 'Error: Invalid verification code';
				$error['attempt'] = $rowcount;
				die(json_encode($error));
			}
		}
	if($creds['rem'] == 1)
	$creds['remember'] = true;
	else
		$creds['remember'] = false;
	$user = wp_signon( $creds, false );
	if ( is_wp_error($user) )
	{
		$sql = 'INSERT INTO `user_verify`(`ip_address`, `username`, `host`) VALUES('.$ip_address.', \''.$creds['user_login'].'\', \''.$ip_host.'\')';
		mysql_query($sql);
		$error['msg'] = $user->get_error_message();
		$error['attempt'] = $rowcount;
		die(json_encode($error));
	}
	$error['msg'] = 1;
	if(isset($rowcount) && $rowcount > 1)
	{
		$sql = 'DELETE FROM `user_verify` WHERE (ip_address = '.$ip_address.' OR username = \''.$creds['user_login'].'\')';
		mysql_query($sql);
	}
	die( json_encode($error) );
}
  // creating Ajax call for WordPress  
add_action( 'wp_ajax_nopriv_MyAjaxFunction', 'MyAjaxLogin' );
function getRemoteAddr()
{
	// This condition is necessary when using CDN, don't remove it.
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND $_SERVER['HTTP_X_FORWARDED_FOR'] AND (!isset($_SERVER['REMOTE_ADDR']) OR preg_match('/^127\..*/i', trim($_SERVER['REMOTE_ADDR'])) OR preg_match('/^172\.16.*/i', trim($_SERVER['REMOTE_ADDR'])) OR preg_match('/^192\.168\.*/i', trim($_SERVER['REMOTE_ADDR'])) OR preg_match('/^10\..*/i', trim($_SERVER['REMOTE_ADDR']))))
	{
		if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ','))
		{
			$ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
			return $ips[0];
		}
		else
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	return $_SERVER['REMOTE_ADDR'];
}
function LoginErrorCheck(){
	$ip = getRemoteAddr();
	$ip_address = $ip ? ip2long($ip) : '';
	$ip_host = @gethostbyaddr($ip);
	$sql = 'INSERT INTO `user_verify`(`ip_address`, `host`, `status`) VALUES('.$ip_address.', '.$ip_host.', 1)';
	mysql_query($sql);
	//setcookie('captchacheck', '1', time()+(60*60*24), '/');
	die( '1' );
  }  
  // creating Ajax call for WordPress  
add_action( 'wp_ajax_nopriv_LoginErrorCheck', 'LoginErrorCheck' );

//Create users
function ajaxSignup($user) {
	global $wpdb;
	checkAjaxCall();
  $userdata = array(
	'display_name' => addslashes($_REQUEST['first_name']),
    'user_pass' => addslashes($_REQUEST['user_pass']),
    'user_email' => addslashes($_REQUEST['user_email']),
    'user_login' => addslashes($_REQUEST['user_login']),
	'mobile' => addslashes($_REQUEST['mobile']),
    'role' => addslashes($_REQUEST['role'])
  );
  	if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST['first_name']))
		die('Special characters are not allowed in full name');
	if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_¬]/', $_POST['mobile']))
		die('Invalid mobile number');
	$wpuid = wp_insert_user($userdata);
	if ( is_wp_error($wpuid) )
		die($wpuid->get_error_message());
	$creds = array();
	$creds['user_login'] = addslashes($_REQUEST['user_login']);
	$creds['user_password'] = addslashes($_REQUEST['user_pass']);
	$creds['remember'] = true;
	$user = wp_signon( $creds, false );
	$wpdb->update( 'wp_users', array('mobile' => addslashes($_REQUEST['mobile'])), array( 'ID' => $wpuid ), array('%s'), array('%d'));
	include ABSPATH.'classes/Mail.php';
	$mail = new Mail();
	$mail->signupMail($userdata['user_email']);
	die( '1' );
}
add_action( 'wp_ajax_nopriv_ajaxSignup', 'ajaxSignup' );

function checkUsername() {
	if (username_exists($_REQUEST['user_login']))
		die( '1' );
	die( '0' );
		
}
add_action( 'wp_ajax_nopriv_checkUsername', 'checkUsername' );
add_action( 'wp_ajax_checkUsername', 'checkUsername' );

function checkEmail() {
	if (email_exists($_REQUEST['user_email']))
		die( '1' );
	die( '0' );
		
}
add_action( 'wp_ajax_nopriv_checkEmail', 'checkEmail' );

function resetPassword() {
	$errors = retrieve_password();
	if ( !is_wp_error($errors) ) {
		die( '1' );
	}
	die( '0' );	
}
add_action( 'wp_ajax_nopriv_resetPassword', 'resetPassword' );

function updateUsers() {
	global $current_user, $wpdb;
	get_currentuserinfo();
	if(preg_match('/[\'^£$%&*()}{@#~?><>,|=_¬]/', $_POST['mobile']))
		die('Invalid mobile number');
	$userId = $current_user->ID;
	require_once( ABSPATH . WPINC . '/registration.php');
	if(updateUsername($_REQUEST['user_login'], $userId))
	{
		wp_update_user( array ('ID' => $userId, 'user_pass' => $_REQUEST['user_pass'], 'role' => $_REQUEST['role']) ) ;
		$wpdb->update( 'wp_users', array('mobile' => addslashes($_REQUEST['mobile'])), array( 'ID' => $userId ), array('%s'), array('%d'));
		include ABSPATH.'classes/Mail.php';
		$mail = new Mail();
		$mail->signupMail($current_user->user_email);
	}
	else
		die( '1' );
	die( '0' );
}
add_action( 'wp_ajax_updateUsers', 'updateUsers' );

function writetous()
{
	checkAjaxCall();
	global $current_user, $invalidFbLogin;
	get_currentuserinfo();
	$userId = $current_user->ID;
	if($userId)
	{
		$comment = addslashes($_REQUEST['comment']);
		$id = (int)$_REQUEST['activity_id'];
		$sql = 'INSERT INTO writetous(user_id, activity_id, comment) VALUES('.(int)($userId).', '.$id.', \''.$comment.'\')';
		mysql_query($sql);
	}
	die('1');
}
add_action( 'wp_ajax_writetous', 'writetous' );

function newsletterSubcription()
{
	$email = addslashes($_REQUEST['email']);
	$sql = 'SELECT * FROM newsletter WHERE email = \''.$email.'\'';
	$result = mysql_num_rows(mysql_query($sql));
	if($result == 0)
	{
		$sql = 'INSERT INTO newsletter(email) VALUES(\''.$email.'\')';
		if(mysql_query($sql))
		{
			include ABSPATH.'/classes/Mail.php';
			$to = $email;
			$mail = new Mail();
			$mail->newsletterMail($to);
		}
	}
	else
		die('0');
	die('1');
}
add_action( 'wp_ajax_nopriv_newsletterSubcription', 'newsletterSubcription' );
add_action( 'wp_ajax_newsletterSubcription', 'newsletterSubcription' );

function updateScore() {
	checkAjaxCall();
	global $current_user, $invalidFbLogin;
	get_currentuserinfo();
	$userId = $current_user->ID;
	$activityId = $_REQUEST['activity_id'];
	$correct = $_REQUEST['correct'];
	$wrong = $_REQUEST['wrong'];
	if($userId)
	{
		$sql = 'INSERT INTO scoreboard(user_id, activity_id, correct, wrong) VALUES('.$userId.', '.$activityId.', '.$correct.', '.$wrong.')';
		mysql_query($sql);
		checkLessonEndState($userId, $activityId);
	}
	else
	{
		$innerData = array();
		$innerData['id'] = $activityId;
		$innerData['correct'] = $correct;
		$innerData['wrong'] = $wrong;
		if(isset($_COOKIE['score']))
			$score = json_decode(urldecode($_COOKIE['score']));
		$score->score[] = $innerData;
		$score->activity[] = $activityId;
		$lessonId = checkLessonEndState('0', $activityId);
		if($lessonId)
			$score->lesson[] = $lessonId;
		setCookieScore($score);
	}
	die('1');
}

function setCookieScore($data)
{
	setcookie('score', urlencode(json_encode($data)), time()+(10 * 365 * 24 * 60 * 60), '/');
}

function checkLessonEndState($userId, $activityId)
{
	$activity = new Activity();
	$lessonId = $activity->getLessonId($activityId);
	$activity = $activity->getActivities($lessonId);
	$lesson = new Lesson();
	if($userId == '0' && isset($_COOKIE['score']))
	{
		$score = json_decode(urldecode($_COOKIE['score']));
		$score->activity[] = $activityId;
		$finished = $score->activity;
		$result = array_intersect($activity, $finished);
		if(count($activity) == count($result))
			return $lessonId;
		return false;
	}
	else
	{
		$finished = $lesson->getFinishedActivity($userId);
		$result = array_intersect($activity, $finished);
		if(count($activity) == count($result))
		{
			$sql = 'INSERT INTO user_lesson_stats(user_id, lesson_id) VALUES('.$userId.', '.$lessonId.')';
			mysql_query($sql);
		}
	}
}
add_action( 'wp_ajax_updateScore', 'updateScore' );
add_action( 'wp_ajax_nopriv_updateScore', 'updateScore' );

function getYourCertificate()
{
	global $current_user;
	get_currentuserinfo();
	$userId = $current_user->ID;
	$cerificateName = $_POST['username'];
	$id = $_POST['id'];
	$sql = 'SELECT GROUP_CONCAT(l.id) AS lesson, GROUP_CONCAT(c.id) AS chapter FROM lessons l
			INNER JOIN chapters c ON c.id = l.chapter_id
			WHERE c.course_id = '.$id;
	$result = mysql_fetch_array(mysql_query($sql));
	$lessonArray = explode(',', $result['lesson']);

	$sql = 'SELECT GROUP_CONCAT(lesson_id) AS lesson FROM user_lesson_stats WHERE user_id = '.$userId;
	$result = mysql_fetch_array(mysql_query($sql));
	$completedLessonArray = explode(',', $result['lesson']);
	$incompleteArray = array_diff($lessonArray, $completedLessonArray);
	$incomplete = implode(',', $incompleteArray);
	if(strlen($incomplete) != 0)
	{
		$sql = 'SELECT GROUP_CONCAT(chapter_id) AS chapter FROM lessons WHERE id IN ('.$incomplete.')';
		$result = mysql_fetch_array(mysql_query($sql));
		$inCompleteChapter = explode(',', $result['chapter']);
	}
	else
		$inCompleteChapter = array();
	if(count($inCompleteChapter) == 0)
	//if(true)
	{
		$payment = new Payment();
		$userPayment= $payment->getUserPayment($userId);
		foreach($userPayment as $payment)
		{
			if($payment['id_course'] == 6)
			{
				$sql = 'SELECT name FROM courses WHERE id = '.$id;
				$result = mysql_fetch_array(mysql_query($sql));
				$courseName = $result['name'];
				$courseStart = date('d-m-y', strtotime($payment['timestamp']));
				$courseEnd = date('d-m-y', strtotime($payment['expiry']));
				break;
			}
			if($payment['id_course'] == $id)
			{
				$courseName = $payment['name'];
				$courseStart = date('d-m-Y', strtotime($payment['timestamp']));
				$courseEnd = date('d-m-Y', strtotime($payment['expiry']));
				break;
			}
		}
		require_once( ABSPATH . '/pdf/pdf-generator.php');
		$pdf = new PDF();
		$pdf->AddPage();
		$pdf->body($cerificateName, $courseName, $courseStart, $courseEnd);
		$fileName = 'certificate'.rand(999, 999999).'.pdf';
		$sql = 'INSERT INTO certificates(id_user, id_course,ceritificate_name, file_path) VALUES('.$userId.', \''.$id.'\',\''.$cerificateName.'\', \''.$fileName.'\')';
		mysql_query($sql);
		$pdf->Output(ABSPATH . 'certificate/'.$fileName, 'F');
	}
	else
	{
		echo 'error';
	}
	die();
}
add_action( 'wp_ajax_getYourCertificate', 'getYourCertificate' );
function getCourseLevel()
{
	checkAjaxCall();
	$sql='SELECT *,c.name AS chaptername,uls.`timestamp` AS times,l.chapter_id AS chapterId FROM user_lesson_stats uls
	INNER JOIN lessons l ON l.id= uls.lesson_id
	INNER JOIN chapters c On c.id =l.chapter_id AND c.course_id='.$_POST['course_id'].'
	INNER JOIN courses  co ON co.id= 1
	WHERE uls.user_id ='.$_POST['user_id'].' GROUP BY  c.id 
	';
	$result = mysql_query($sql);
	$countLive = mysql_num_rows($result);
	while($row = mysql_fetch_array($result))
	{
		$dates = date('Y-m-d',strtotime($row['times']));
		$sql ='SELECT * FROM lessons WHERE chapter_id ='.$row['chapterId'].'';
		$res = mysql_query($sql);
		$countChapter = mysql_num_rows($res);
		
		$sql='SELECT * FROM lessons l
			INNER JOIN user_lesson_stats uls ON uls.lesson_id =l.id AND uls.user_id ='.$_POST['user_id'].'
			WHERE l.chapter_id ='.$row['chapterId'].' GROUP BY uls.lesson_id';
		$res = mysql_query($sql);
		$counts = mysql_num_rows($res);
		$width =($counts/$countChapter)*100;	
		$sql='SELECT * FROM chapters c
			INNER JOIN lessons l ON l.chapter_id =c.id
			INNER JOIN lesson_activity la ON la.lesson_id =l.id
			WHERE c.id='.$row['chapterId'].' AND c.course_id ='.$_POST['course_id'].'';
		$countAct = mysql_query($sql);	
		$countActvitity = mysql_num_rows($countAct);
		$sql='SELECT * FROM chapters c
			INNER JOIN lessons l ON l.chapter_id =c.id
			INNER JOIN lesson_activity la ON la.lesson_id =l.id
			INNER JOIN scoreboard s ON s.activity_id = la.activity_id AND s.user_id ='.$_POST['user_id'].'
			WHERE c.id='.$row['chapterId'].' GROUP BY la.activity_id';
		$countAct = mysql_query($sql);	
		$countActvitityTwo = mysql_num_rows($countAct);
		
	echo '
			<div class="classFixedClass">
				<div class="headerlist">'.$row['chaptername'].'</div>
				<div class="headerlist" style="width:101px"><div class="barclass" style="margin:5px 0 0 30px"><div class="grenBar" style="width:'.$width.'%"></div></div></div>
				<div class="headerlist">'.$dates.'</div>
				<div class="headerlist">'.$countActvitityTwo.'/'.$countActvitity.'</div>
			</div>
			<div class="border-class-Content"></div>
	';
	}
	if($countLive== 0)
	{
		echo '<div class="classFixedClass" style=" font-weight:bold; font-size:18px;  text-align:center; ">No data</div>';
	}
	exit;
}
add_action( 'wp_ajax_getCourseLevel', 'getCourseLevel' );
function getCourseHistroy()
{
	checkAjaxCall();
	include('course-history-template.php');
	exit;
}

add_action( 'wp_ajax_getCourseHistroy', 'getCourseHistroy' );


function getPersonalInfo()
{
	checkAjaxCall();
	include('personal-info-template.php');
	exit;
}	
add_action( 'wp_ajax_getPersonalInfo', 'getPersonalInfo' );

function getMyCerificates()
{
	checkAjaxCall();
	include('my-certificate-template.php');
	exit;
}

add_action( 'wp_ajax_getMyCerificates', 'getMyCerificates' );

function getMyNotes()
{
	checkAjaxCall();
 	global $current_user;
	echo '
		<div class="headerNotesClassContent">
			<div class="firstClassContent" id="levelId-1" onclick="note(1);">Level-1 Beginner</div>
			<div class="firstClassContent" id="levelId-4" onclick="note(4);">Level-2 Intermediate</div>
			<div class="firstClassContent" id="levelId-5" onclick="note(5);">Level-3 Advanced</div>
		</div>
		<div class="contentClassMynotes">
			<div class="MynotesContainnor">
				<div class="whitesContent">
				<ul>';
				$sql="SELECT * FROM notes WHERE course_id='".$_POST['couresId']."' AND user_id='".$current_user->ID."'";
				
				$result = mysql_query($sql);
				while($row =mysql_fetch_array($result))
				{
					$a = html_entity_decode($row['notes']);
					echo $a;
				}
				echo '
				</ul>';
				if(mysql_num_rows($result) == 0)
				{
					echo '<div style=" text-align:center; font-weight:bold; font-size:20px; float:left; width:100%;">No Notes</div>';
				}	
				echo '</div>
			</div>
		</div>
	';
	exit;
}

add_action( 'wp_ajax_getMyNotes', 'getMyNotes' );

function getEmailCertificate()
{
	checkAjaxCall();
	global $current_user ;
	$to =  $current_user->user_email;
	$sql="SELECT * FROM certificates cer 
		INNER JOIN courses c ON	c.id = cer.id_course
		WHERE cer.id_user ='".$current_user->ID."' AND cer.id_course ='".$_REQUEST['id']."' ";
	$row =mysql_fetch_array(mysql_query($sql));	
	$attachments = array(ABSPATH . 'certificate/'.$row['file_path']);
	$subject = 'Course completion certificate - EnglishStrokes';
	$headers = 'Course Completion'; 
	$message .= __('Dear ').$current_user->display_name. ",\r\n\r\n";
	$message .= __('                              Congratulations! You have successfully completed '.$row['name'].' of EnglishStrokes. Your certificate is ready for your use.')."\r\n\r\n\r\n\r\n";
	$message .= __('Best wishes.')."\n";
	$message .=  __('EnglishStrokes team.');
	
	echo  wp_mail( $to, $subject, $message, $headers, $attachments );
	exit;
}
add_action( 'wp_ajax_getEmailCertificate', 'getEmailCertificate' );

function getLesson()
{
	checkAjaxCall();
	global $current_user;
	get_currentuserinfo();
	$return = array();
	$id = (int)($_REQUEST['id']);
	$lesson = new Lesson($id);
	$payment = new Payment();
	$premiumUser = false;
	$chapterId = $lesson->chapter_id;
	$chapter = new Chapter($chapterId);
	if($payment->checkUserStatus($current_user->ID, $chapter->course_id))
		$premiumUser = true;
	if($chapter->paid == 0 || $premiumUser)
	{
		foreach($lesson->videos as $video)
		{
			$videos = new Video($video);
			$videoUrl = 'https://www.englishstrokes.com/uploads/videos/';
			$return['video'][] = '<iframe src="'.get_bloginfo('url').'/video-play.php?vid1='.urlencode($videoUrl.$videos->mp4).'&vid2='.urlencode($videoUrl.$videos->webm).'&vid3='.urlencode($videoUrl.$videos->m4v).'&vid4='.urlencode($videoUrl.$videos->ogv).'&poster='.urlencode('https://www.englishstrokes.com/uploads/posters/'.$videos->poster).'&caption='.urlencode('https://www.englishstrokes.com/uploads/captions/'.$videos->caption).'" id="frame'.$lesson->id.'" height="100%" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen style="background: black"></iframe>';
			$return['videoid'][] = $video;
		}
		foreach($lesson->activity as $activity)
		{
			$audios = new Activity($activity);
			if($audios->type == 6)
				$return['activity'][] = '
				<div style="margin:30px auto; width:600px; margin-top:30px;">
					<object type="application/x-shockwave-flash" data="'.get_bloginfo('url').'/games/trivia-quiz-loader.swf" width="600px" height="400px" id="flashgame">
						<param name="movie" value="'.get_bloginfo('url').'/games/trivia-quiz-loader.swf"/>
						<param name="allowFullScreen" value="true" />
						<param name="flashVars" value="loadXml='.urlencode($audios->url.'&id='.$audios->id).'"/>
						<embed src="'.get_bloginfo('url').'/games/trivia-quiz-loader.swf" width="600" height="400" style="position:relative;"  flashVars="loadXml='.urlencode($audios->url.'&id='.$audios->id).'" allowFullScreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en" />
						<img alt="" src="" style="position:absolute;left:0;" width="600" height="400" title="Video playback is not supported by your browser" />
					</object>
				</div>';
			else
				$return['activity'][] = '<iframe class="frame" id="frame" src="'.get_bloginfo('url').'/activity/'.$audios->url.'?id='.$audios->id.'&course='.$chapter->course_id.'&count=1" width="100%" height="100%" scrolling="no" frameborder="0" ></iframe>';
			$return['activityid'][] = $audios->id;
		}
	}
	else
		$return = 'error';
	echo json_encode($return);
	exit;
}

add_action( 'wp_ajax_getLesson', 'getLesson' );
add_action( 'wp_ajax_nopriv_getLesson', 'getLesson' );

function getCurrentLessonStatus()
{
	checkAjaxCall();
	global $current_user;
	get_currentuserinfo();
	$lessonId = (int)$_REQUEST['id'];
	$lesson = new Lesson();
	$activity = new Activity();
	$activity = $activity->getActivities($lessonId);
	$finished = $lesson->getFinishedActivity($current_user->ID);
	$result = array_intersect($activity, $finished);
	$cId = (int)$_REQUEST['cid'];
	$course = new Course($cId);
	$return = array();
	$return['total'] = $course->getActComplStaus($current_user->ID);
	$return['current'] = ((count($result)/count($activity))*100);
	echo json_encode($return);
	exit;
}
add_action( 'wp_ajax_getCurrentLessonStatus', 'getCurrentLessonStatus' );
add_action( 'wp_ajax_nopriv_getCurrentLessonStatus', 'getCurrentLessonStatus' );

function facebookLogin()
{
	require 'src/facebook.php';
	global $fbuser;
	$facebook = new Facebook(array(
	  'appId'  => APP_ID,
	  'secret' => APP_SECRET,
	));
	
	$user = $facebook->getUser();
	if ($user)
	{
		try
		{
			$fbuser = $facebook->api('/me');
			$wpuid = fbc_fbuser_to_wpuser($fbuser['id']);
			global $current_user;
			get_currentuserinfo();
			$userId = $current_user->ID;
			if(!$wpuid && !$userId)
				$wpuid = fbc_insert_user($fbuser);
			if($wpuid && is_integer($wpuid))
			{
				wp_set_current_user($wpuid);
				wp_set_auth_cookie($wpuid, true, false);
			}
			else if($userId)
			{
				$fbuid = $fbuser['id'];
				update_usermeta($userId, 'facebook_id', $fbuid);
			}
			
		} catch (FacebookApiException $e) {}
	}
}

function get_user_by_meta($meta_key, $meta_value)
{
  global $wpdb;
  $sql = "SELECT user_id FROM $wpdb->usermeta WHERE meta_key = '%s' AND meta_value = '%s'";
  return $wpdb->get_var($wpdb->prepare($sql, $meta_key, $meta_value));
}

function updateUsername($username, $user_id)
{
	global $wpdb;
	if (!username_exists($username))
		return $wpdb->update( 'wp_users', array('user_login' => $username), array('ID' => $user_id) );
	else
		return false;
}

function fbc_fbuser_to_wpuser($fbuid)
{
  return (int)get_user_by_meta('facebook_id', $fbuid);
}

function fbc_insert_user($me) {
	$fbuid = $me['id'];
	$userinfo = $userinfo[0];
	$fbusername = $fbuid;
	if (username_exists($fbusername))
		return 'FBC_ERROR_USERNAME_EXISTS';
  $userdata = array(
	'display_name' => $me['name'],
    'first_name' => $me['first_name'],
    'last_name' => $me['last_name'],
    'user_pass' => wp_generate_password(),
    'user_email' => $me['email'],
    'user_login' => $fbusername,
    'role' => 'student'
  );
  $wpuid = wp_insert_user($userdata);
  if ( is_wp_error($wpuid) )
		echo '<div style="text-align:center; height:30px; line-height:30px; color:#f00; width:100%; float:left"><b>'.$wpuid->get_error_message().'</b></div>';
  // $wpuid might be an instance of WP_Error
  if($wpuid && is_integer($wpuid)) {
    update_usermeta($wpuid, 'facebook_id', "$fbuid");
  }
  else
	return $wpuid;
  return (int)$wpuid;
}

if(isset($_REQUEST['login']))
	facebookLogin();

add_action('admin_menu','wphidenag');
function wphidenag() {
	remove_action( 'admin_notices', 'update_nag', 3);
}

function remove_the_dashboard ()
{
	if (current_user_can('level_10'))
	{
		return;
	}
	else
	{
		global $menu, $submenu, $user_ID;
		$the_user = new WP_User($user_ID);
		reset($menu); $page = key($menu);
		while ((__('Dashboard') != $menu[$page][0]) && next($menu))
		$page = key($menu);
		if (__('Dashboard') == $menu[$page][0]) unset($menu[$page]);
		reset($menu); $page = key($menu);
		while (!$the_user->has_cap($menu[$page][1]) && next($menu))
		$page = key($menu);
		if (preg_match('#wp-admin/?(index.php)?$#',$_SERVER['REQUEST_URI']) && ('index.php' != $menu[$page][2]))
		wp_redirect(get_option('siteurl'));
	}
}
add_action('admin_menu', 'remove_the_dashboard');

function updateLastVisit()
{
	global $current_user;
	get_currentuserinfo();
	$userId = $current_user->ID;
	if($userId)
	{
		$date = date('Y-m-d H:i:s');
		$sql = 'UPDATE wp_users SET `last_visit` = \''.$date.'\' WHERE ID = '.$userId;
		mysql_query($sql);
	}
}
updateLastVisit();
function my_login_redirect( $redirect_to, $request, $user ){
  return home_url();
}
add_filter("login_redirect", "my_login_redirect", 10, 3);

function getCourseDetails()
{
	checkAjaxCall();
	include('get-course-details-template.php');
	exit;
}

add_action( 'wp_ajax_getCourseDetails', 'getCourseDetails' );
add_action( 'wp_ajax_nopriv_getCourseDetails', 'getCourseDetails' );

function updateUserPlay()
{
	checkAjaxCall();
	global $current_user;
	get_currentuserinfo();
	$lessonId = (int)$_REQUEST['id'];
	$cId = (int)$_REQUEST['cid'];
	$current = get_user_meta( $current_user->ID, 'user_course_resume', true );
	$result = array();
	if(strlen($current) == 0)
		$result[$cId] = $lessonId;
	else
	{
		$result = json_decode($current, true);
		$result[$cId] = $lessonId;
	}	
	update_user_meta($current_user->ID, 'user_course_resume', json_encode($result));
	exit;
}
add_action( 'wp_ajax_updateUserPlay', 'updateUserPlay' );

function updateUserNotes()
{
	checkAjaxCall();
	global $current_user;
	get_currentuserinfo();
	$userNotes = htmlentities($_REQUEST['notes']);
	$cId = (int)$_REQUEST['cid'];
	$notes = new Notes();
	$notes->updateNotes($cId, $userNotes);
	exit;
}
add_action( 'wp_ajax_updateUserNotes', 'updateUserNotes' );

function getUserNotes()
{
	checkAjaxCall();
	global $current_user;
	get_currentuserinfo();
	$cId = (int)$_REQUEST['cid'];
	$notes = new Notes();
	$return = $notes->getNotes($cId);
	echo html_entity_decode($return);
	exit;
}
add_action( 'wp_ajax_getUserNotes', 'getUserNotes' );

function showSignup()
{
	checkAjaxCall();
	include('signup-template.php');
	exit;
}
add_action( 'wp_ajax_nopriv_showLogin', 'showLogin' );

function showLogin()
{
	checkAjaxCall();
	include('login-template.php');
	exit;
}
add_action( 'wp_ajax_nopriv_showSignup', 'showSignup' );

function forgotPassword()
{
	checkAjaxCall();
	global $wpdb;
	parse_str($_POST['input_data'], $totalForm);
	if ( !wp_verify_nonce( $totalForm['tg_pwd_nonce'], "tg_pwd_nonce"))
		die('No trick please');
	if(empty($totalForm['email']))
		die('Please enter your Username or E-mail address');
	//We shall SQL escape the input
	$user_input = $wpdb->escape(trim($totalForm['email']));
	if ( strpos($user_input, '@') )
	{
		$user_data = get_user_by_email($user_input);
		if(empty($user_data) || $user_data->caps[administrator] == 1)
			die('Invalid E-mail address!');
	}
	else
	{
		$user_data = get_userdatabylogin($user_input);
		if(empty($user_data) || $user_data->caps[administrator] == 1)
			die('Invalid Username!');
	}
	$user_login = $user_data->user_login;
	$user_email = $user_data->user_email;

	$key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
	if(empty($key))
	{
		$key = wp_generate_password(20, false);
		$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
	}

	$message = __('Someone requested that the password be reset for the following account:') . "\r\n\r\n";
	$message .= get_option('siteurl') . "\r\n\r\n";
	$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
	$message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
	$message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
	$message .= get_bloginfo('url') . "/reset-password/?action=reset_pwd&key=$key&login=" . rawurlencode($user_login) . "\r\n";
	
	if ( $message && !wp_mail($user_email, 'Password Reset Request', $message))
		die('Email failed to send for some unknown reason.');
	else
		die('1');
}
add_action( 'wp_ajax_nopriv_forgotPassword', 'forgotPassword' );

function checkAjaxCall()
{
	if(isset($_SERVER['HTTP_REFERER']))
	{
		$parse_url = parse_url($_SERVER['HTTP_REFERER']);
		if($parse_url['host'] != $_SERVER['HTTP_HOST'])
			die('error');
	}
	else
		die('error');
}

//Redirect for wp-admin security issue
//if(!isset($_REQUEST['action']))
//	if((strpos($_SERVER[REQUEST_URI],'wp-admin') !== false) && $_SERVER[HTTP_HOST] == 'www.englishstrokes.com')
//		header('Location: http://xldworld.englishstrokes.com');