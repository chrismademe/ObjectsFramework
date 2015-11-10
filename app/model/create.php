<?php

use Objects\Objects;

$objects = new Objects($medoo);
$objects->create( array(
    'alias' => 'hello-world',
    'type'  => 'post'
) );
