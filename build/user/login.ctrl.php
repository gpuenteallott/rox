<?php


class LoginController
{
    public function loginCallback($args, $count, $memory)
    {
        $memory->sayhallo = 'loginCallback';
        if (!$user = APP_User::login($args->post['u'], $args->post['p'])) {
            // uuh
            $memory->login_errors = 'login_failed';
        } else if (!$user->loggedIn()) {
            $memory->login_errors = 'login_failed';
        } else {
            $memory->login_errors = false;
        }
        
        if (isset($args->post['memory'])) {
            $str = $args->post['memory'];
            $memory->prev = $str;
        } else {
            $memory->prev = false;
        }
        
        if (isset($args->post['redirect_req'])) {
            return $args->post['redirect_req'];
        }
    }
}


?>