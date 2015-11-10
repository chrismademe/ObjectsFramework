<?php

// Check Medoo plugin is active
if ( !plugin_is_active('medoo') ) {
    throw new Exception('Objects requires Medoo to be installed and active');
}
