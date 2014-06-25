<?php
//require_once('db_connect_fns.php');
include_lib('db_connect_fns');
require_once('includes/constants.php');
class profile_handler
{
    # Add new user record to the database ----------------------------------------------------------------------------*/
    public function register_user($user_name, $name=null, $surname=null, $email, $password, $date_of_birth=null,
                                   $gender)
    {
        # encrypt password:
        $password_encrypted = md5($password);

        $sql = 	"INSERT INTO ".PROFILE_TABLE."(".USER_NAME.", ".NAME.", ".SURNAME.", ".EMAIL.", ".PASSWORD.", ".DOB.",
                         ".GENDER.") ".
                "VALUES('$user_name', '$name', '$surname', '$email', '$password_encrypted', '$date_of_birth',
                         '$gender')";

        $result = mysql_query($sql);

        if(!$result)
        {
            die('Could not enter data: ' . mysql_error());
        }

        echo "Entered data successfully\n";

        return true;

        mysql_close($connect);
    }


    # Check user profile data ----------------------------------------------------------------------------------------*/
    public function check_user_profile($column_name, $ref_value)
    {
        $sql = "SELECT * FROM ".PROFILE_TABLE." WHERE ".$column_name." = '".$ref_value."'";

        $result = mysql_query($sql);

        if(mysql_num_rows($result))
        {
            return true;
        }
        else
        {
            return false;
        }
        mysql_close($connect);
    }

    public function check_user_password($user_password)
    {
        $sql = "SELECT * FROM ".PROFILE_TABLE." WHERE ".PASSWORD." = '".md5($user_password)."'";

        $result = mysql_query($sql);

        if(mysql_num_rows($result))
        {
            return true;
        }
        else
        {
            return false;
        }
        mysql_close($connect);
    }

    public function get_user_profile_data($email)
    {
         $sql = " SELECT ".USER_ID.", ".USER_NAME.", ".NAME.", ".SURNAME.", ".EMAIL.", CONCAT(DAY(".DOB."),' ', MONTHNAME(".DOB."), ' ', YEAR(".DOB.")) 'dob' ".
                " FROM ".PROFILE_TABLE."".
                " WHERE ".EMAIL." = '".$email."'";

        $result = mysql_query($sql);

        if(!$result)
        {
            die('Could not retrieve data: ' . mysql_error() . "\n". $sql);
        }

        $details = array();

        while($row = mysql_fetch_array($result))
        {
            $details[] = $row;
        }

        return $details;
    }

    public function get_dob($format = 1, $email)
    {
        if($format == 1)
        {
          $sql = "SELECT	MONTHNAME(date_of_birth) FROM  	www_user_profile";
        }
    }


    # Retrieve Gravatar associated with users email address ----------------------------------------------------------*/
    public function get_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array()) {
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$s&d=$d&r=$r";
        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }

        return $url;
    }


    # Update user profile data ---------------------------------------------------------------------------------------*/
    public function update_user_profile($column_name, $new_value, $email)
    {
        $sql = "UPDATE   ".PROFILE_TABLE."".
            "SET ".$column_name." = '$new_value'".
            "WHERE 	".EMAIL." = '$email'";

        $result = mysql_query($sql);

        if(!$result)
        {
            die('Could not update data: ' . mysql_error());
        }

        echo "Updated data successfully\n";

        return true;
    }

    public function update_user_password($new_value, $email)
    {
        $sql = "UPDATE   ".PROFILE_TABLE."".
            "SET ".PASSWORD." = '$new_value'".
            "WHERE 	".EMAIL." = '$email'";

        $result = mysql_query($sql);

        if(!$result)
        {
            die('Could not update data: ' . mysql_error());
        }

        echo "Updated data successfully\n";

        return true;
    }
}

?>