<?php
	require_once("db_connect_fns.php");
	
	class blogger	{
	
		public function get_blogs()	{
			
		$result = mysql_query(
			"SELECT *
			FROM blog
			ORDER BY date DESC");
			
			$details = array();
			
			while($row = mysql_fetch_array($result))
			{	
				$details[] = $row;
			}
			
			return $details;
			mysql_close($connect);
		}

		#Saving a blog post
		public function	insert_blog($user_id, $entry_text)	{

            $entry_text = mysql_real_escape_string($entry_text);

            //var_dump($entry_text);

			$sql = 	"INSERT INTO blog".
					"(user_id, blog_text) ".
					"VALUES($user_id, '$entry_text')";
			
			$result = mysql_query($sql);
            //var_dump($sql);
			
			if(!$result)
			{
			  die('Could not enter data: ' . mysql_error());
			}
			
			echo "Entered data successfully\n";
			
			return true;
			
			mysql_close($connect);
		}

		#Shows all blogs
		public function	show_all_blogs()	{
		
			$blogs = $this->get_blogs();
			$user_gravatar = $this->get_gravatar('');
					
			for($i=0; $i < count($blogs); $i++)
			{
				$user_id = $blogs[$i]['id'];
				$date = $blogs[$i]['date'];
				$blog = $blogs[$i]['blog_text'];
						
				echo "<img src='".$user_gravatar."' alt='gravatar'/>" ." ";
				echo "<i>". $user_id ."</i>"." \t";
				echo $blog ." \t";
				echo "<i>(". $date .")</i>";
				echo "<br/><br/>";
                //echo "<hr/>";
			}
		}

		#Saves a comment - UNTESTED
		public function	insert_comment($user_id, $comment, $blog_id)	{
			$sql = 	"INSERT INTO blog_comment(user_id, comment_text, blog_id)".
					"VALUES($user_id, '$comment', $blog_id)";
			
			$result = mysql_query($sql);
			
			if(!$result)
			{
			  die('Could not enter data: ' . mysql_error());
			}
			
			echo "Entered data successfully\n";
			
			return true;
			
			mysql_close($connect);
		}

		#Gravatar
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

		public function register_user($name, $surname, $gender, $dob, $contact, $password)	{
			
			$sql = 	"INSERT INTO users(name, surname, gender, dob, email, contact, psswd)".
					"VALUES($name, $surname, $gender, $dob, $contact, $password)";

            $result = mysql_query($sql);

            if(!$result)
            {
                die('Could not enter data: ' . mysql_error());
            }

            echo "User registered successfully\n";

            return true;

            mysql_close($connect);
		}
		public function date_drop_down()	{
			
			$year = array();
			$month = array();
			$day = array();
			$dob = array();
			
			for($i=0; $i<61; $i++)
			{
				//$year[$i] = 1938 + $i;
				$dob["year"][$i] = 1938 + $i;
			}
			
			for($i=0; $i<12; $i++)
			{
				$monthNum = 1 + $i;
				//$month[$i] = date("F", mktime(0, 0, 0, $monthNum, 10));
				$dob["month"][$i] = date("F", mktime(0, 0, 0, $monthNum, 10));
			}
			
			for($i=0; $i<31; $i++)
			{
				//$day[$i] = 1 + $i;
				$dob["day"][$i] = 1 + $i;
			}
			
			return $dob;
		}
		
		public function date_boxes()	{
			//$dob = $this->date_drop_down();
			//var_dump($dob);
									
			/*echo "<select>";
				for($i=0; $i,count($dob["month"]); $i++)
				{
					echo"<option>".$dob["month"][$i]."</option>";
				}
			echo "</select>";*/
			
			$month = array();
			
			$month[0] = "January";
			$month[1] = "February";
			$month[2] = "March";
			$month[3] = "April";
			
			echo "<select>";
				for($i=0; $i,count($month); $i++)
				{
					echo"<option>".$month[$i]."</option>";
				}
			echo "</select>";
			
		}
	}

?>