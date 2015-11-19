<?php

function get_fields( $args = null ) {

    /**
     * Get Objects class
     */
    global $fields;

    /**
     * Get objects
     */
    return $fields->get( $args );

}
