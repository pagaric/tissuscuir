<?php

function sayHello()
{
    return 'Hello World !';
}

function d($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}

function r($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function rd($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    die();
}
