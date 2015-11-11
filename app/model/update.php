<?php

$posts = $objects->get( array('type' => 'post') );

foreach ( $posts as $post ) {
    if ( $post->hasFields() ) {
        print_r( $fields->get( array('object' => $post->ID) ) );
    }
}
