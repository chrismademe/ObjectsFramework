<?php

function field_exists( $ID ) {

    /**
     * Get Objects class
     */
    global $field;

    /**
     * Run query
     */
    return $field->exists($ID);

}
