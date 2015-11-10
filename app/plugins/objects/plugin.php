<?php

/**
 * @package Objects Framework
 * @version 1.0.0
 *
 * A collection of classes and
 * functions to help build
 * content for PHPSF apps.
 */

use Objects\Objects;

/**
 * Dependencies
 */
require_once __DIR__ .'/lib/dependencies.php';

/**
 * Classes
 */
require_once __DIR__ .'/lib/classes.php';

/**
 * Create a new instance of
 * Objects
 */
$objects = new Objects($medoo);
