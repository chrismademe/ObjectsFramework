<?php

namespace Objects;

class Object {

    /**
     * Object Properties
     */
    private $ID;
    private $parent;
    private $owner;
    private $type;
    private $alias;
    private $date;
    private $modified;
    private $status;

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
        return false;
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
