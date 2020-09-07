<?php
/**
 * Assign active class to nav links
 * @param $name string route name of current page
 * @return string class to assign
 */
function setActiveRoute($name, $className = 'active')
{
    return (request()->routeIs($name) || request()->is($name)) ? $className : '';
}

