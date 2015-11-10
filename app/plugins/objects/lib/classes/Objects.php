<?php

namespace Objects;
use Exception;
use medoo;

class Objects {

    /**
     * Database object
     */
    private $db;

    /**
     * Database config
     */
    private $config = array();

    /**
     * Required Properties
     */
    private $required;

    /**
     * Properties
     */
    private $properties;

    /**
     * Construct
     */
    public function __construct(medoo $db, array $config = null) {

        // Database
        $this->db = $db;

        // Set default config
        $this->config = array(
            'table'     => 'objects'
        );

        // Override config
        if ( !is_null($config) ) {
            foreach ($config as $key => $value) {
                if ( array_key_exists($key, $this->config) ) {
                    $this->config[$key] = $value;
                }
            }
        }

        // Required properties
        $this->required = array(
            'type',
            'alias'
        );

        // Available properties
        $this->properties = array(
            'ID',
            'parent',
            'owner',
            'type',
            'alias',
            'date',
            'modified',
            'status'
        );

    }

    /**
     * Set
     */
    public function __set( $property, $value ) {
        if ( property_exists($this, $property) ) {
            $this->$property = $value;
        }
    }

    /**
     * Get
     *
     * Returns either a single
     * or array of Objects
     */
    public function get( array $args = null ) {

        // Set input arguments
        if ( !is_null($args) ) {
            foreach ( $args as $arg => $value ) {
                if ( $this->isValidProperty($arg) ) {
                    $options[$arg] = $value;
                }
            }
        }

        // Build Where Statement
        switch(true) {

            // No Arguments
            case !isset($options):
                $where = false;
            break;

            // More than 1 arguments
            case count($options) > 1:
                $where = array(
                    'AND' => $options
                );
            break;

            // 1 argument
            default:
                $where = $options;
            break;

        }

        // Query
        $query = $this->db->select(
            $this->config['table'],
            '*',
            $where
        );

        // If empty, return false
        if ( !$query ) {
            return false;
        }

        // Create 'Object' objects
        foreach ( $query as $object ) {
            $the_objects[] = new Object($object);
        }

        return $the_objects;

    }

    /**
     * Create
     *
     * Create a new object
     */
    public function create( array $fields ) {

        // Check for required fields
        if ( !$this->hasRequiredProperty($fields) ) {
            throw new Exception('Missing required fields');
        }

        // Check Alias does not already exists
        if ( $this->exists( $fields['alias'] ) ) {
            throw new Exception('Object with this alias already exists!');
        }

        // Query
        $query = $this->db->insert(
            $this->config['table'],
            $fields
        );

        // Check response
        if ( !$query ) {
            return false;
        }

        return true;

    }

    /**
     * Update
     *
     * Update existing object
     */
    public function update( $ID, array $fields ) {

        // Check object exists
        if ( !$this->exists($ID) ) {
            throw new Exception('Object does not exist');
        }

        // Insert date modified
        $fields['modified'] = Helpers::timestamp();

        // Query
        $query = $this->db->update(
            $this->config['table'],
            $fields,
            array( 'ID' => $ID )
        );

        // Check response
        if ( !$query ) {
            return false;
        }

        return true;

    }

    /**
     * Delete
     *
     * Delete existing object
     */
    public function delete( $ID ) {

        // Check object exists
        if ( !$this->exists($ID) ) {
            throw new Exception('Object does not exist');
        }

        return $this->update( $ID, array('status' => -1) );

    }

    /**
     * Remove
     *
     * Actually deletes the object from
     * the database.
     *
     * Use with caution, this cannot be
     * undone!
     */
    public function remove( $ID ) {

        // Check object exists
        if ( !$this->exists($ID) ) {
            throw new Exception('Object does not exist');
        }

        return $this->db->delete(
            $this->config['table'],
            array( 'ID' => $ID )
        );

    }

    #########################################
    ### Helpers                           ###
    #########################################

    /**
     * Exists
     *
     * Check to see whether an object
     * exists
     */
    public function exists( $ID ) {

        // Check ID is int or string
        if ( !is_int($ID) && !is_string($ID) ) {
            throw new Exception('Invalid input, ID must be Integer or String');
        }

        // Check for ID or alias
        if ( is_int($ID) ) {
            $modifier = 'ID';
        } else {
            $modifier = 'alias';
        }

        // Query database
        return $this->db->has(
            $this->config['table'],
            array( $modifier => $ID )
        );

    }

    /**
     * Get ID
     *
     * Get object ID from
     * alias.
     */
    public function getID( $alias ) {

        // Query
        $query = $this->db->select(
            $this->config['table'],
            array( 'ID' ),
            array( 'alias' => $alias )
        );

        if ( !$query ) {
            return false;
        }

        return $query[0]['ID'];

    }

    /**
     * Required Data
     */
    private function hasRequiredProperty( array $input ) {

        // Check $input is an array
        if ( !is_array($input) ) {
            return false;
        }

        // Check $input for required fields
        foreach ( $this->required as $required ) {
            if ( !array_key_exists($required, $input) ) {
                return false;
            }
        }

        return true;

    }

    /**
     * Is Valid Field
     *
     * Array of valid fields to
     * query in get/select functions
     */
    private function isValidProperty( $field ) {
        return in_array( $field, $this->properties );
    }

}
