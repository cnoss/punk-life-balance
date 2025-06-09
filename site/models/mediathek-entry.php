<?php

class MediathekEntryPage extends Page
{
    
    public function cover()
    {
        return $this->content()->get('cover')->toFile() ?? $this->image();
    }

    public function youtube()
    {

        $videoId = $this->content()->get('youtube');

        return "
            <div class=\"video\">
                <iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/{$videoId}\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>
            </div>";
    }

    public function audioContainer()
    {   
        if($this->audioexamples()->isEmpty()){
            return '';
        }

        $container = [];
        foreach($this->audioexamples()->toStructure() as $audioItem){

            $title = !$audioItem->title()->isEmpty() 
                ? "<p class=\"title\">{$audioItem->title()}</p>" 
                : "<p class=\"title\">{$audioItem->filename()}</p>";

            $desc = !$audioItem->desc()->isEmpty() 
                ? "<p class=\"desc\">{$audioItem->desc()}</p>" 
                : "";

            $snip = "
                <div class=\"audio\">
                    {$title}
                    {$desc}
                    <audio controls><source src=\"{$audioItem->audiodata()->toFile()->url()}\" type=\"{$audioItem->audiodata()->toFile()->mime()}\"></audio>
                </div>";
            array_push($container, $snip);
        }

        return implode($container);
    }
}


