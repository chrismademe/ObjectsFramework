<?php

use Objects\Objects;

function get_child_object( $ID, $parent ) {
    global $medoo;

    /**
     * New Objects Class
     */
    $obj = new Objects($medoo);

    /**
     * Get ID Type of Child
     */
    $type = (is_string($ID) && !is_numeric($ID) ? 'alias' : 'ID');

    /**
     * Get ID Type of Parent
     */
    $parent_type = (is_string($parent) && !is_numeric($parent) ? 'alias' : 'ID');

    /**
     * Get objects
     */
    return $obj->get( array(
        'AND' => array(
            $type           => $ID,
            $parent_type    => $parent
        )
    ) );

}
