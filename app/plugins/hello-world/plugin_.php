<?php

/**
 * @package Hello World
 *
 * Example plugin to show how
 * to make use of Plugins to
 * manipulate site data.
 */

if ( !function_exists('hello_world') ) { // Only run if another hello_world() function does not exist

    function hello_world() {
        global $variables; // Get Variables object

        // Run only on the homepage
        if ( is_home() ) {
            $variables->addVar('hello_world', 'Hello World!'); // Add a new theme variable
        }
    }

    // Add the action to on_model_init's trigger
    $triggers->addAction('on_model_init', 'hello_world'); // Run plugin on model load.

}
