<?php


namespace genfors;


class AdminCtrl extends AbstractCtrl implements CtrlInterface
{

    public function do()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            switch ($this->CD->getRelevantArg()) {
                case 'add_user':
                    $user = User::new($post['username'], $_POST['password'], 0, 1);
                    print "Created active non-admin user {$user->getUsername()}, with id {$user->getID()}";
                    break;
                case 'activate_user':
                    $user = User::withID($post['id']);
                    $user->activate();
                    print "Activated user with id {$user->getID()}";
                    break;

                case 'deactivate_user':
                    $user = User::withID($post['id']);
                    $user->deactivate();
                    print "Deactivated user with id {$user->getID()}";
                    break;

                case 'activate_election':
                    $election = Election::withID($post['election_id']);
                    $election->activate();
                    break;
                case 'end_election':
                    $election = Election::withID($post['election_id']);
                    $election->deactivate();
                    break;
            }

            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $view = new View($this->CD);
            switch ($this->CD->getRelevantArg()) {

                case 'add_user':
                    $view->display('Admin/create_user.php');
                    break;

                case 'view_user':
                    $user = User::withID($this->CD->getFinalArg());
                    $view->set('user', $user);
                    $view->display('Admin/view_user.php');
                    break;

                case 'new_election':
                    $view->display('Admin/create_election.php');
                    break;

                case 'manage_election':
                    $election = Election::withID($this->CD->getFinalArg());
                    $view->set('election', $election);
                    $view->display('Admin/election_view.php');
                    break;
            }
        }
    }
}