<?php

return function () {
    return page('news')
        ->children()
        ->listed()
        ->filterBy('kind', '!=','termin')
        ->sortBy('date', 'desc');
};
