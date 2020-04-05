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
                            MainCtrl::redirect('/?a=login');
                        }
                        Session::loginUser($user);
                        MainCtrl::redirect('/?a=election');
                    } else {
                        Misc::setError("Invalid credentials!");
                        MainCtrl::redirect('/?a=login');
                    }
            }

            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $view = new View($this->CD);

            switch ($this->CD->getRelevantArg()) {
                case 'logout':
                    Session::destroy();
                    MainCtrl::redirect('/?a=login');
                    break;
                case '':
                default:
                    $view->display('Login/login.php');
                    break;
            }

        }
    }
}