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
                    if ($_POST['password'] !== $_POST['password2']) {
                        Misc::setError('Passwords mismatch!');
                        MainCtrl::redirect("/?a=admin/add_user");
                    }

                    if (strlen($_POST['password']) < 8) {
                        Misc::setError('Passordet er ikke langt nok!');
                        MainCtrl::redirect("/?a=admin/add_user");
                    }

                    if (($test = User::withUsername($post['username'])) !== null) {
                        Misc::setError('Brukernavnet er allerede i bruk!');
                        MainCtrl::redirect("/?a=admin/add_user");
                    }

                    $user = User::new($post['username'], $_POST['password'], 0, 1);
                    print "Created active non-admin user {$user->getUsername()}, with id {$user->getID()}";
                    Misc::setSuccess('La til brukeren med navnet ' . $post['username']);
                    MainCtrl::redirect("/?a=admin/add_user");
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

                case 'deactivate_all_users':
                    Misc::setSuccess('Deactivated all users!');
                    User::deactivateAll();
                    break;

                case 'activate_all_users':
                    User::activateAll();
                    Misc::setSuccess('Activated all users!');
                    break;

                case 'activate_election':
                    $election = Election::withID(intval($post['election_id']));
                    $election->activate();
                    break;
                case 'end_election':
                    $election = Election::withID(intval($post['election_id']));
                    $election->deactivate();
                    break;

                case 'new_election':
                    $election = Election::create($post['title'], $post['description'], $post['alternatives']);
                    print $election->getId();
                    Misc::setSuccess("Opprettet et nytt valg!");
                    MainCtrl::redirect('/?a=admin/new_election');
            }

            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $view = new View($this->CD);
            switch ($this->CD->getRelevantArg()) {

                case 'add_user':
                    $view->display('Admin/create_user.php');
                    break;

                case 'user_overview':
                    $view->set('users', User::all());
                    $view->display('Admin/user_overview.php');
                    break;
                case 'view_user':
                    $user = User::withID($this->CD->getFinalArg());
                    $view->set('user', $user);
                    $view->display('Admin/view_user.php');
                    break;

                case 'new_election':
                    $view->display('Admin/create_election.php');
                    break;

                case 'election_overview':
                    $view->set('elections', Election::all());
                    $view->display('Admin/election_overview.php');
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