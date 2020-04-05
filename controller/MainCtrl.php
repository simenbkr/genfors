<?php


namespace genfors;


class MainCtrl extends AbstractCtrl implements CtrlInterface
{
    public function do()
    {

        if ($this->CD->getRelevantArg() == 'login') {
            $ctrl = new LoginCtrl($this->CD->shiftArg());
            $ctrl->do();
            exit();
        }

        Session::refresh();
        if (is_null(Session::getActiveUser())) {
            self::redirect("/?a=login");
        }

        $user = Session::getActiveUser();

        if (!$user->isActive() && !$user->isAdmin()) {
            Session::destroy();
            self::redirect("/?a=login");
        }

        switch ($this->CD->getRelevantArg()) {

            case 'admin':
                if ($user->isAdmin()) {
                    $ctrl = new AdminCtrl($this->CD->shiftArg());
                    $ctrl->do();
                } else {
                    Misc::setError("You do not have access to this page.");
                    self::redirect('/?a=election');
                }
                break;
            default:
            case 'vote':
                $ctrl = new VoteCtrl($this->CD->shiftArg());
                $ctrl->do();
                break;
        }
    }

    public static function redirect($where)
    {
        header("Location: $where");
        exit();
    }
}