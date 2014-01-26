<?php

class Auth
{
    private static $provider = 'http://49.212.150.224:5816/library.ajax.php';

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
        $conn = curl_init();
        curl_setopt($conn, CURLOPT_URL, Auth::$provider);
        curl_setopt($conn, CURLOPT_VERBOSE, 0);
        curl_setopt($conn, CURLOPT_TIMEOUT, 10);
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($conn, CURLOPT_POST, 1);
        curl_setopt($conn, CURLOPT_POSTFIELDS, http_build_query(array(
            'username' => $username,
            'password' => $password
        )));

        $rv = curl_exec($conn);
        curl_close($conn);
        if (!$rv) {
            return false;
        }
        $rv = json_decode($rv, true);

        $_SESSION['stuid'] = $rv['student_number'];
        $_SESSION['username'] = $rv['student_name'];
        $_SESSION['is_login'] = '1';
        return true;
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

        return UserModel::readOne(Auth::getUserInfos());
    }

    public static function getUserInfos()
    {
        if (!Auth::isLogin()) {
            return;
        }

        return array(
            'name' => $_SESSION['username'],
            'student_id' => $_SESSION['stuid']
        );
    }
}
