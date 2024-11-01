<?php

/*
 * Plugin Name: Visibility Viewer 
 * Plugin URI: http://www.manaope.com/plugin/visibility-viewer
 * Description: Provide content visibility handler for private page, by display a custom error message if anonymous user
 * Author: Finau H Kaufusi
 * Author URI: http://www.manaope.com/contact
 * Version: 1.0.1
 */

 function visibility_viewer_alter_private_query($posts, $query) {
 	
 	if($posts[0]->post_status == "private" && $posts[0]->post_type == "page" && !is_user_logged_in()){
 		
 		$redirect_to = '?redirect_to=' . esc_url($_SERVER["REQUEST_URI"]);
 		
 		$posts[0]->post_status = "publish";
 		$posts[0]->post_content = '<div class="error"><div>Sorry, you must be logged in to view this page</div><div><a href="'.wp_login_url().$redirect_to.'" title="Login" class="btn btn-primary">Login</a></div></div>';
 		$posts[0]->comment_status = "close";
 		$posts[0]->comment_count = 0;
 	}

    return $posts;
}
add_filter('posts_results', 'visibility_viewer_alter_private_query', 1, 2);
?>
