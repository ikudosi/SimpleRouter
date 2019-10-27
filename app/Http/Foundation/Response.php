<?php

namespace App\Http\Foundation;

class Response
{
    protected $content;

    /**
     * Response constructor.
     * @param $content
     */
    public function __construct($content)
    {
        $this->content = $content;
        $this->parseContent($content);
        $this->setHeaders($content);
    }

    /**
     * @param $content
     */
    public function parseContent($content)
    {
        if (!is_string($content)) {
            $this->content = json_encode($content);
        }
    }

    /**
     * @param $content
     */
    public function setHeaders($content)
    {
        if (headers_sent()) {
            return;
        }

        if (is_string($content)) {
            header("Content-type:text/hml");

            if (is_array(json_decode($content))) {
                header("Content-type:application/json");
            }
        }

        if (is_array($content)) {
            header("Content-type:application/json");
        }
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return $this
     */
    public function send()
    {
        echo $this->content;
        return $this;
    }
}