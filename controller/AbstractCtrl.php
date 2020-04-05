<?php


namespace genfors;


abstract class AbstractCtrl
{
    protected CtrlData $CD;

    public function __construct(CtrlData $CD)
    {
        $this->CD = $CD;
    }

}