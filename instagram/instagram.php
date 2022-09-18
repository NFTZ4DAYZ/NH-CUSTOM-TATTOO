<?php
/*
 * Instagram Script
 * Author: Webisir
 * Author URI: http://themeforest.net/user/webisir
 * Based on https://gist.github.com/cosmocatalano/4544576
*/

// detect if an ajax request exists
if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) {

    // Search criteria (it will used as username by default)
    $search = '';
    // Set to TRUE to use the search criteria as tag
    $tag = false;

    /* ========================================================================== */

    if ( $tag ) {
        $search = 'explore/tags/' . $search;
        $array_indexes = array('TagPage','hashtag','edge_hashtag_to_media');
    } else {
        $array_indexes = array('ProfilePage','user','edge_owner_to_timeline_media');
    }

    // get data
    $insta_source = file_get_contents( 'http://instagram.com/' . $search );
    $shards = explode( 'window._sharedData = ', $insta_source );
    $insta_json = explode( ';</script>', $shards[1] );
    $results_array = json_decode( $insta_json[0], TRUE );

    // extract last pics
    $pics_array = $results_array['entry_data'][$array_indexes[0]][0]['graphql'][$array_indexes[1]][$array_indexes[2]]['edges'];

    $images = array();

    // get all url pics
    foreach( $pics_array as $pic ) {
        $images[] = $pic['node']['thumbnail_src'];
    }

    echo json_encode( $images );

}