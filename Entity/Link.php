<?php
namespace Acme\TaskBundle\Entity;

class Link
{
    protected $link;

    protected $title;

    public function getLink()
    {
        return $this->link;
    }
    public function setLink($link)
    {
        $this->link = $link;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title = null)
    {
        $this->title = $title;
    }
}