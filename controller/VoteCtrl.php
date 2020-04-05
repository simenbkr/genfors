<?php


namespace genfors;


class VoteCtrl extends AbstractCtrl implements CtrlInterface
{
    public function do()
    {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            switch ($this->CD->getRelevantArg()) {

                case 'vote':
                    $user = Session::getActiveUser();
                    $election = Election::withID($post['election_id']);
                    $alternative = $election->getAlternative($post['alternative_id']);
                    $election->registerVote($alternative, $user);
                    break;
            }
            return;
        }

        if($_SERVER['REQUEST_METHOD'] === 'GET') {

            $view = new View($this->CD);
            switch ($this->CD->getRelevantArg()) {

                case 'election':
                    $election = Election::withID($this->CD->getFinalArg());
                    $view->set('election', $election);
                    $view->display('Election/election_view.php');
                    break;
                case 'overview':
                case '':
                default:
                    $view->set('elections', Election::allActive());
                    $view->display('Election/election_overview.php');
                    break;
            }
        }


    }

}