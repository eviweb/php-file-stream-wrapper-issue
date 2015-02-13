<?php

/**
 * autoload function
 *
 * @param string $class requested class to load
 */
function __autoload($class)
{
    $file = __DIR__.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';

    if (file_exists($file)) {
        require_once $file;
    }
}

/**
 * print the test description
 */
function print_description()
{
    echo '<p><i>Click twice on each of the following links to see what\'s going on:</i></p>';
}

/**
 * display a menu of the tests
 */
function print_menu()
{
    $html = '<ul>';
    $html.= '   <li><a href="/explicit-file">Example with explicit file protocol (expected behaviour)</a></li>';
    $html.= '   <li><a href="/implicit-file">Example with no file protocol specified (buggy behaviour ?)</a></li>';
    $html.= '</ul>';

    echo $html;
}

/**
 * print the page title built form the given uri
 *
 * @param string $uri request uri
 */
function print_title($uri)
{
    echo '<h3>'.ucfirst(ltrim($uri, '/')).' - Test</h3>';
}

/**
 * perform the routing between the tests
 *
 * @param string $uri request uri
 */
function route($uri)
{
    print_description();
    print_menu();

    if ($uri !== '/' && file_exists(__DIR__.$uri.'.php')) {
        print_title($uri);

        include __DIR__.$uri.'.php';
    }
}

route($_SERVER['REQUEST_URI']);
