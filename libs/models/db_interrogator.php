<?php
abstract class DbInterrogator
{
    public $db;
    public $db_table;

    function __construct()
    {
        $init = $this->init();
        $this->db = $init['db'];
    }

    public function init()
    {
        $config = TConfig('Database');

        $creds = array();
        $creds['hostadress'] = $config->host;
        $creds['username'] = $config->user_name;
        $creds['password'] = $config->password;
        $creds['db'] = $config->database;

        return $creds;
    }

    /*-----------=============CONNECT TO DATABASE===============----------------*/
    public function db_connect()
    {
        $creds = $this->init();

        $hostadress = $creds['hostadress'];
        $username = $creds['username'];
        $password = $creds['password'];
        $my_sql_db = $creds['db'];

        $mysqi = new mysqli($hostadress, $username, $password, $my_sql_db);

        if (mysqli_connect_errno())
            die('Could not connect to MySQL: ' . mysqli_connect_error());

        return $mysqi;
    }


    /*-----------=============TYPICAL SQL TRANSACTIONS===============----------------*/

    #Get
    public function get_data($table, $columns = null, $where = '1=1')
    {
        if(!empty($columns))
            $sql = 'SELECT '. $columns ."\n". ' FROM '. $table ."\n";
        else
            $sql = 'SELECT * '. "\n" .'FROM '. $table ."\n";

        if(is_array($where))
        {
            $where_arr_count = count($where);
            $sql .= ' WHERE ';
            foreach($where as $column=>$new_value)
            {
                $sql .= $column .' = "'. $new_value .'"';
                if($where_arr_count > 1)
                {
                    $sql .= ' AND ';
                    $where_arr_count --;
                }
            }
        }

        $result = $this->run_sql($sql);

        if($result) {return $result;}
        else {return false; }
    }

    #Post
    public function insert_data($table, $column_values)
    {
        $to_insert = $this->prepare_for_insert($column_values);

        $columns = $to_insert['columns'];
        $values = $to_insert['values'];

        $sql  = 'INSERT INTO '.$table. ' ('.$columns.')' ."\n";
        $sql .= 'VALUES ('.$values.')';

        $this->run_sql($sql);
        return true;
    }

    #Update
    public function update_data($table, $columns, $where)
    {
        $sql  = 'UPDATE '. $table .' SET ';

        if(is_array($columns))
        {
            $arr_count = count($columns);

            foreach($columns as $column=>$new_value)
            {
                $sql .= $column .' = "'. $new_value .'"';
                if($arr_count > 1)
                {
                    $sql .= ', ';
                    $arr_count --;
                }
            }
        }
        else
        {
            die('deifne column to be updated and value within an array e.g: <b>array(\'column\'=>\'value\')</b>');
        }

        if(is_array($where))
        {
            $where_arr_count = count($where);
            foreach($where as $column=>$new_value)
            {
                $sql .= ' WHERE '. $column .' = "'. $new_value .'"';
                if($where_arr_count > 1)
                {
                    $sql .= ' AND ';
                    $where_arr_count --;
                }
            }
        }
        else
        {
            die('deifne WHERE condition within an array e.g: <b>array(\'column\'=>\'value\')</b>');
        }

        $result = $this->run_sql($sql);

        return $result;
    }

    #Delete and entire record
    public function delete_data($table, $where)
    {
        $sql  = 'DELETE FROM '. $table;

        if(is_array($where))
        {
            foreach($where as $column=>$new_value)
                $sql .= ' WHERE '. $column .' = "'. $new_value .'"';
        }
        else
        {
            die('deifne WHERE condition within an array e.g: <b>array(\'column\'=>\'value\')</b>');
        }

        $this->run_sql($sql);

        return true;
    }

    /*-----------==============MYSQL FUNCTIONS==============----------------*/
    public function run_sql($query)
    {
        $mysqli = $this->db_connect();

        $result = $mysqli->query($query);

        if(!$result) { die('Could not execute query: ' . mysql_error() . "\n". $query); }

        # Iterate through each row of the result and save each line into an array.
        $data = array();
        try
        {
            while($row = @mysqli_fetch_array($result)) { $data[] = $row; }

            //while($row = $result->fetch_assoc()) { $data[] = $row; }
            //$result->free(); # free result set
        }
        catch(Exception $e)
        {
            return 'Could not fetch rows: ' . $e;
        }

        #Close connection
        $mysqli->close();

        return $data;
    }

    # Checks if a record already exists
    public function record_exists($where)
    {
        //var_dump($where);
        $table = $this->db_table;
        $result = $this->get_data($table, null, $where);

        if($result) {return true;}
        else {return false; }
    }

    public function prepare_for_insert($column_values)
    {
        $columns = '';
        $values = '';
        $i = 1;
        $total_coulmns_values = count($column_values);
        $prepared = array();

        foreach($column_values as $column => $value)
        {
            # Checks to see if it's on the last column and value so as to avoid adding an
            # unwanted trailing comma.
            if($i == $total_coulmns_values)
            {
                $columns .=  $column;

                # Checks if value is a string and escapes it accordingly
                if(is_string($value)) { $values .= '"'.mysqli_real_escape_string($this->db_connect(), $value).'"'; }
                else { $values .= '"'. $value .'"'; }
            }
            else
            {
                $columns .= $column.', ';

                if(is_string($value)) { $values .= '"'.mysqli_real_escape_string($this->db_connect(), $value).'", '; }
                else { $values .= $value.', '; }
            }
            $i++;
        }

        $prepared['columns'] = $columns;
        $prepared['values'] = $values;

        return $prepared;
    }

    public function db_tables()
    {
        $sql = 'SHOW TABLES FROM ' . $this->db;
        $result = $this->run_sql($sql);
        foreach($result as $table) {$tables[] = $table[0];}
        return $tables;
    }

    public function table_columns($table)
    {
        $sql = 'DESCRIBE ' . $table;
        $result = $this->run_sql($sql);
        $fields = array();
        foreach($result as $columns) {$fields[] = $columns['Field'];}
        return $fields;
    }
}
