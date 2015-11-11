<?php

$posts = $objects->get( array('type' => 'video') );

foreach ( $posts as $post ) {

    $channels[$post->ID] = array(
        'date' => $post->date,
        'alias' => $post->alias
    );

    if ( $post->hasFields() ) {

        // Get Fields
        $field = $fields->get( array('object' => $post->ID) );

        // Populate fields
        foreach ( $field as $item ) {
            $channels[$post->ID][$item->alias] = $item->value();
        }

    }

}

Objects\Helpers::dump($channels);
