<?php


namespace genfors;


class AdminCtrl extends AbstractCtrl implements CtrlInterface
{

    public function do()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            switch ($this->CD->getRelevantArg()) {
                case 'adduser':
                    $user = User::new($post['username'], $_POST['password'], 0, 1);
                    print "Created active non-admin user {$user->getUsername()}, with id {$user->getID()}";
                    break;
                case 'activate':

                    break;

                case 'deactivate':

                    break;
            }

            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            switch ($this->CD->getRelevantArg()) {

                case 'adduser':

            }
        }


    }

}