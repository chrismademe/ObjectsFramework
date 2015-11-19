<?php

namespace Objects;

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
     * Has fields
     *
     * Checks to see whether this object
     * has fields attached to it.
     */
    public function hasFields() {

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
        $query = Helpers::db()->query("SELECT EXISTS(SELECT * FROM ".Helpers::quote('objects')." INNER JOIN ".Helpers::quote('fields')." ON ".Helpers::quote('objects').".".Helpers::quote('ID')." = ".Helpers::quote('fields').".".Helpers::quote('object')." WHERE ". Helpers::quote('fields') .".".Helpers::quote('object')." = ". $this->ID ." AND ". Helpers::quote('objects') .".".Helpers::quote('ID')." = ".Helpers::quote('fields').".".Helpers::quote('object').")");

        /**
         * Get result
         */
        $result = $query->fetchAll();
        return $result[0][0];

    }

    /**
     * Has Children
     *
     * Check to see if there are any
     * objects with the parent ID of
     * this object
     */
    public function hasChildren() {

        /**
         * Run Query
         */
        $query = Helpers::db()->has(
            Helpers::table('objects'),
            array( 'parent' => $this->ID )
        );

        return $query;

    }

    /**
     * Is Child
     *
     * Check to see whether
     * this object has a parent
     */
    public function isChild() {
        return $this->parent > 0;
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

    /**
     * Is Owner
     *
     * Checks to see whether specified
     * user ID is the owner of this object
     */
    public function isOwner( $userID ) {
        return $this->owner === $userID;
    }

}
