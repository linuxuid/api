<?php 
namespace View;

class View
{
    private $path;

    private $extraVars = [];

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function setVariable(string $name, $value) : void
    {
        $this->extraVars[$name] = $value;
    }

    public function renderHtml(string $name, array $vars = [], int $code = 200)
    {
        extract($vars);

        extract($this->extraVars);

        http_response_code($code);

        include $this->path . '/' . $name;
    }
}

?>