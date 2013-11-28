<?php
//require_once('../config.php');
    class UserHandler
    {
        public function validate_login($u_name, $u_pword)
        {
            $config = new Config();

            if(!empty($u_name))
            {
                $user_name = $u_name;
                if($user_name == $config->user_name)
                {
                    if(!empty($u_pword))
                    {
                        $pword = $u_pword;
                        if($pword == $config->user_pword)
                        {
                            $_SESSION['admin_active'] = $u_name;
                            header('Location: open_file.php');
                            return;
                        }
                        else
                        {
                            $feedback = 'Incorrect login details!';
                            //echo 'Incorrect login details!';
                        }
                    }
                    else
                    {
                        $feedback = 'Please enter password';
                        //echo 'Please enter password';
                    }
                }
                else
                {
                    $feedback = 'Incorrect login details!';
                    //echo 'Incorrect login details!';
                }
            }
            else
            {
                $feedback = 'Please enter your details';
                //echo 'Please enter your details';
            }

            header('Location: index.php?feedback='.$feedback);

            echo $feedback;
        }

        public function logout()
        {
            # unset session variables
            unset($_SESSION['admin_active']);
            unset($_SESSION['start_time']);

            #destroy session
            session_destroy();

            # redirect user back to index page
            header('Location: index.php');
        }
    }

?>