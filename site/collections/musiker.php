<?php

return function () {


    if (page('musikanten') == null) {
        return null;
    }
    if (page('musikanten')->children() == null) {
        return null;
    }


    return page('musikanten')
        ->children()
        ->listed();
};
