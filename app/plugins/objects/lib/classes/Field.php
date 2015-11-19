<?php

namespace Objects;

class Field {

    /**
     * Object Properties
     */
    public $ID;
    public $object;
    public $parent;
    public $type;
    public $alias;
    public $label;
    public $value;
    public $date;
    public $modified;
    public $status;

    /**
     * Construct
     */
    public function __construct( array $properties ) {

        // Set Properties
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
     * Value
     *
     * Return property value
     */
    public function value() {
        if ( !empty( $this->value ) ) {
            return $this->value;
        }
    }

    /**
     * Has Children
     *
     * Check to see whether
     * this field has any
     * child fields.
     */
    public function hasChildren() {

        /**
         * Run Custom Query
         * to check whether
         * we have fields attached
         *
         * NOTE: Medoo did not want
         * to play ball and kept
         * quoting where not
         * necassary so this is
         * a direct query
         */
        $query = Helpers::db()->has(
            Helpers::table('fields'),
            array( 'parent' => $this->ID )
        );

        return $query;

    }

    /**
     * Is Child
     *
     * Check to see whether
     * this field has a parent
     */
    public function isChild() {
        return $this->parent > 0;
    }

    /**
     * Is Hidden
     */
    public function isHidden() {
        return $this->type === 'hidden';
    }

    /**
     * Is Published
     */
    public function isPublished() {
        return $this->status === 1;
    }

    /**
     * Is Deleted
     */
    public function isDeleted() {
        return $this->status === -1;
    }

    /**
     * Is Modified
     */
    public function isModified() {
        return !empty($this->modified);
    }

}
