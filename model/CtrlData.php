<?php


namespace genfors;


class CtrlData
{
    private array $arg;
    private int $pos;
    private ?User $activeUser;
    private $rot;
    private $base;
    private $db;

    public function __construct($arg, $pos = 0, $rot = 0)
    {
        $this->arg = (array)$arg;
        $this->pos = $pos;
        $this->activeUser = null;
        $this->rot = $rot;
        $this->base = array();
        $this->db = DB::getDB();
    }

    public function getArg($pos)
    {
        return isset($this->arg[$pos]) ? $this->arg[$pos] : null;
    }

    public function getAllArgs()
    {
        return isset($this->arg) ? $this->arg : null;
    }

    public function getRelevantArgPos()
    {
        $len = count($this->arg);
        return $len > $this->pos ? $this->pos : -1;
    }

    public function getRelevantArg()
    {
        $pos = $this->getRelevantArgPos();
        return $pos == -1 ? null : $this->arg[$pos];
    }

    public function getFinalArg()
    {
        $len = count($this->arg);
        return $len > 0 ? $this->arg[$len - 1] : null;
    }

    public function shiftArg()
    {
        $copy = new self($this->arg, $this->pos + 1, $this->rot);
        $copy->setActiveUser($this->activeUser);
        return $copy;
    }

    public function skiftArgMedRot($activeUser)
    {
        $kopi = new self($this->arg, $this->pos + 1, $this->pos);
        $kopi->setActiveUser($activeUser);
        return $kopi;
    }

    public function setActiveUser($activeUser)
    {
        $this->activeUser = $activeUser;
    }

    public function getAktivBruker()
    {

        if (is_null($this->activeUser) && isset($_SESSION['brid'])) {
            $this->activeUser = Session::getAktivBruker();
        }

        return $this->activeUser;
    }

    public function getBase($pos = 0)
    {
        $pos += $this->rot - 1;
        if (!isset($this->base[$pos])) {
            if ($this->rot == 0 || count($this->arg) < $pos) {
                $this->base[$pos] = '';
            } else {
                $this->base[$pos] = implode('/', array_slice($this->arg, 0, $pos + $this->rot)) . '/';
            }
        }
        return '?a=' . $this->base[$pos];
    }

    public function isAdmin() {
        return Session::get('is_admin') == 'yes';
    }
}