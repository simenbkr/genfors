<?php


namespace genfors;


class View extends AbstractCtrl
{
    private array $var;

    public function __construct(CtrlData $CD)
    {
        parent::__construct($CD);
        $this->var = array();
    }

    public function set($key, $val)
    {
        $this->var[$key] = $val;
    }

    public function display($viewpath)
    {
        if (!is_string($viewpath)) {
            throw new \Exception('Input must be a string!');
        }
        $path = __DIR__ . DS . '..' . DS . 'view' . DS . $viewpath;
        if (!file_exists($path)) {
            throw new \Exception('Could not display ' . $viewpath);
        }

        foreach ($this->var as $key => $val) {
            ${$key} = $val;
        }
        require_once($path);
    }
}