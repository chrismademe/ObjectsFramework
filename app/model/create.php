<?php

$objects->create( array(
    'alias'     => 'hello-world-5',
    'type'      => 'post',
    'status'    => 1
) );


$fields->create( array(
    'object'    => $objects->ID,
    'alias'     => 'title',
    'type'      => 'text',
    'label'     => 'Title',
    'value'     => 'This is a Blog Article',
    'status'    => 1
) );

$fields->create( array(
    'object'    => $objects->ID,
    'alias'     => 'body',
    'type'      => 'wysiwyg',
    'label'     => 'Body',
    'value'     => 'This is a Blog Article',
    'status'    => 1
) );

print_r($medoo);
