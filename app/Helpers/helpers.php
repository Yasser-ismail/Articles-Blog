<?php

function is_active($routeName)
{
    if ((request()->segment(2) !== null && request()->segment(2) == $routeName) || (request()->segment(2) == 'home' && request()->segment(1) == $routeName)) {
        return 'active';

        //return request()->segment(2) !== null && request()->segment(2) !== $routeName ? 'active' : '';

    }

}
