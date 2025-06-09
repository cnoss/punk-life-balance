<?php

return function () {
    return page('news')
        ->children()
        ->listed()
        ->filterBy('kind', 'termin')
        ->filterBy('date', 'date >', date('Y-m-d', strtotime('-1 month')))
        ->sortBy('date', 'asc');
};
