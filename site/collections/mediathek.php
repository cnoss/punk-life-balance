<?php

return function () {
    if (page('mediathek') == null) {
        return null;
    }
    if (page('mediathek')->children() == null) {
        return null;
    }
    return page('mediathek')
        ->children()
        ->listed();
};
