<?php

function the_field( $ID, $object = null ) {

    /**
     * Get field object
     */
    $field = get_field( $ID, $object );

    /**
     * Verify object
     */
    if ( !is_object($field) ) {
        return false;
    }

    /**
     * Return field value
     */
    return $field->value();

}
