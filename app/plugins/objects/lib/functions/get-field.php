<?php

function get_field( $ID, $object = null ) {

    /**
     * Get Objects & Fields class
     */
    global $fields;
    global $objects;

    /**
     * Get ID Type
     */
    $type = (is_string($ID) && !is_numeric($ID) ? 'alias' : 'ID');

    /**
     * Set field ID
     */
    $object = ($objects->current_object ? $objects->current_object : $object);

    if ( is_null($object) ) {
        throw new Exception('Invalid field ID or Alias');
    }

    /**
     * Get fields
     */
    $field = $fields->get( array(
        'object'    => $object,
        $type       => $ID
    ) );

    /**
     * Field Object
     */
    return $field[$ID];

}
