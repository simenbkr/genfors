<?php


namespace genfors;


class LoginCtrl extends AbstractCtrl implements CtrlInterface
{
    public function do()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            switch ($this->CD->getRelevantArg()) {
                case '':
                default:
                    if ((($user = User::withUsername($_POST['username'])) != null && $user->verifyPassword($_POST['password']))) {
                        if (!$user->isActive()) {
                            Misc::setError("This user is not active!");
                        }
                        Session::loginUser($user);
                    } else {
                        Misc::setError("Invalid credentials!");
                    }
            }

            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view = new View($this->CD);

            switch ($this->CD->getRelevantArg()) {
                case '':
                default:
                    $view->display('Login/login.php');
                    break;
            }

        }
    }
}