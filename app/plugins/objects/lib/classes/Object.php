<?php

namespace Objects;

use Exception;
use medoo;

class Object {

    /**
     * Object Properties
     */
    public $ID;
    public $parent;
    public $owner;
    public $type;
    public $alias;
    public $date;
    public $modified;
    public $status;

    /**
     * Construct
     */
    public function __construct( array $properties ) {
        foreach ( $properties as $property => $value ) {
            if ( property_exists($this, $property) ) {
                $this->$property = $value;
            }
        }
    }

    /**
     * Get
     */
    public function __get( $property ) {
        if ( property_exists($this, $property) ) {
            return $this->$property;
        }
    }

    /**
     * Set
     */
    public function __set( $property, $value ) {
        return;
    }

    /**
     * Is Published
     */
    public function isPublished() {
        return $this->status === 1;
    }

    /**
     * Is Modified
     */
    public function isModified() {
        return !empty($this->modified);
    }

}
