<?php

namespace Objects;
use Exception;
use medoo;

class Fields {

    /**
     * Database object
     */
    private $db;

    /**
     * Database config
     */
    private $config = array();

    /**
     * Required Fields
     */
    private $required;

    /**
     * Construct
     */
    public function __construct(medoo $db, array $config = null) {

        // Database
        $this->db = $db;

        // Set default config
        $this->config = array(
            'table'     => 'fields'
        );

        // Override config
        if ( !is_null($config) ) {
            foreach ($config as $key => $value) {
                if ( array_key_exists($key, $this->config) ) {
                    $this->config[$key] = $value;
                }
            }
        }

        // Required Fields
        $this->required = array(
            'type',
            'alias',
            'label',
            'value'
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
     * Create
     *
     * Create a new object
     */
    public function create( array $fields ) {

        // Check for required fields
        if ( !$this->hasRequiredFields($fields) ) {
            throw new Exception('Missing required fields');
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
            throw new Exception('Field does not exist');
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
        return $this->update( $ID, array('status' => -1) );
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

        // Check ID is int
        if ( !is_int($ID) ) {
            throw new Exception('ID must be an integer');
        }

        // Query database
        return $this->db->has(
            $this->config['table'],
            array( 'ID' => $ID )
        );

    }

    /**
     * Required Data
     */
    private function hasRequiredFields( $input ) {

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

}
