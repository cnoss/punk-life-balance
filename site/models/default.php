<?php

use Kirby\Cms\Page;

class DefaultPage extends Page
{
    /**
     * This method is now available for all pages
     * unless they have their own page model.
     */
    public function myCustomMethod(): string
    {
        return 'Hello world';
    }
}