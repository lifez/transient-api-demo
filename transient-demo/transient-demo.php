<?php
/*
 * Plugin Name: Transient Demo
 * Description: Transient Demo
 * Version: 0.0.1
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

function render_feed() {
    if ( $content = get_transient( 'transient-feed' ) ) {
        return $content;
    }else {
        return generate_content();
    }
}

function generate_content() {
    $args = array( 'posts_per_page' => 10 );
    $posts = get_posts( $args );

    $content = '';
    foreach ( $posts as $post ) {
        $content .= '<p>' . $post->post_title . '</p>';
    }
    set_transient( 'transient-feed', $content );
    return $content;
}

add_shortcode( 'transient-demo', render_feed );

add_action( 'save_post', 'generate_content' );
add_action( 'delete_post', 'generate_content' );
