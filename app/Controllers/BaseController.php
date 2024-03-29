<?php

namespace App\Controllers;


abstract class BaseController {

    protected $content = '';
    /**
     * Mostra layout/index.php.
     */
    public abstract function display(): void;
    

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getContent():string
    {
        return $this->content;
    }
}
