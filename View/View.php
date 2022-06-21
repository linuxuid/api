<?php 
namespace View;

class View
{
    protected $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function renderHtml(string $name, array $vars = [])
    {
        extract($vars);

        include $this->path . '/' . $name;
    }
}

?>