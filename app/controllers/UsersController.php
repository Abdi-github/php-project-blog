<?php

require "app/models/User.php";

class UsersController
{

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Process Form
            // Sanitize the form

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_name' => trim($_POST['user_name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'user_name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',

            ];

// Validation of user_name
            if (empty($data['user_name'])) {
                $data['user_name_err'] = 'Please enter user_name';
            }

// Validation of email

            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter an email';
            } else {

                if (User::fetchByEmail($data['email'])) {
                    $data['email_err'] = 'The email is already taken';
                }
            }

// Validation of Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

// Validation of Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords does not match';
                }
            }

// Making sure errors are empty
            if (empty($data['user_name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
// Validated

// Password Hashing

                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

/**
 * Registration of users
 * Once the user is register by passing the above constraints, the page will be redirected to
 * the login page
 */

                if (User::register($data)) {
                    flash('register_success', 'You have successfully registered');
                    Helper::redirect('login');
                } else {
                    die('something went wrong');
                }

            } else {
// Load View with errors
                return Helper::view('register', $data);
            }

        } else {
// initialization of data
            $data = [
                'user_name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'user_name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',

            ];

            return Helper::view('register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process Form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Pleae enter email';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            /**
             * chacking for the user email if it exist or not while attempting to login
             */

            if (User::fetchByEmail($data['email'])) {
                // Found

            } else {
                $data['email_err'] = 'The email you entered is not registered';
            }

            // Make sure errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                /**
                 * Check and set logged in users once the above criterias are fulfilled
                 */
                $loggedInUser = User::login($data['email'], $data['password']);
                if ($loggedInUser) {
                    // Create session

                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password is not correct';
                    return Helper::view('login', $data);

                }
            } else {
                // Load view with errors
                return Helper::view('login', $data);
            }
        } else {
            // initialization of data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',

            ];
            return Helper::view('login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->user_name;

        Helper::redirect('posts');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        Helper::redirect('login');

    }
    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;

        }
    }

}
