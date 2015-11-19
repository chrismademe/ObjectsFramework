<?php

/**
 * @package Objects Framework
 * @version 1.0.0
 *
 * A collection of classes and
 * functions to help build
 * content for Poco apps.
 */

use Objects\Objects;
use Objects\Fields;

/**
 * Dependencies
 */
require_once __DIR__ .'/lib/dependencies.php';

/**
 * Classes
 */
require_once __DIR__ .'/lib/classes.php';

/**
 * Functions
 */
require_once __DIR__ .'/lib/functions.php';

/**
 * Create a new instance of
 * Objects & Fields
 */
$objects    = new Objects($medoo);
$fields     = new Fields($medoo);
