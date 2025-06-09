<?php

class NewsEntryPage extends Page
{
    
    public function cover()
    {
        return $this->content()->get('cover')->toFile() ?? $this->image();
    }

    public function youtube()
    {

        $videoId = $this->content()->get('youtube');

        return snippet('youtube', ['videoId' => $videoId]);
    }

}
