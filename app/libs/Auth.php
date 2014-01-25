<?php

class Auth
{
    private static function prepareSession()
    {
        if (!isset($_SESSION['is_login'])) {
            $_SESSION['is_login'] = '';
        }
        
        if (!isset($_SESSION['username'])) {
            $_SESSION['username'] = '';
        }
        
        if (!isset($_SESSION['stuid'])) {
            $_SESSION['stuid'] = '';
        }
    }

    /**
     * Check current user is login.
     *
     * @return bool
     */
    public static function isLogin()
    {
        Auth::prepareSession();
        return $_SESSION['is_login'] === '1';
    }

    /**
     * Login a user.
     *
     * @param string user login name
     * @param string user password
     * @return bool login success or not
     */
    public static function login($username, $password)
    {
        try {
            $helper = new \LibraryAJAX();
            $helper->setup($username, $password);
            $helper->login();
            $infos = $helper->getInfos();
            $_SESSION['stuid'] = $infos['student_number'];
            $_SESSION['username'] = $infos['student_name'];
            $_SESSION['is_login'] = '1';

            return true;
        } catch (\LoginException $e) {
            return false;
        }
    }

    /**
     * Logout current user.
     */
    public static function logout()
    {
        if (!Auth::isLogin()) {
            return;
        }

        $_SESSION['is_login'] = '0';
    }

    /**
     * Get current user.
     *
     * @return mixed
     */
    public static function getUser()
    {
        if (!Auth::isLogin()) {
            return;
        }

        return array(
            'username' => $_SESSION['username'],
            'stuid' => $_SESSION['stuid']
        );
    }
}
