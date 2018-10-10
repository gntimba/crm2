<?php
class DBConnection extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function dbConfig($email){

        /*$efg="";
        $data = explode('.',$_SERVER['SERVER_NAME']);
        if (!empty($data[0])) {
            $efg = $data[0];
        }

        $sql="SELECT DbUsername,DbName,DbPassword FROM abc WHERE efg=?";
        $d_result=$this->db->query($sql,array($efg))->result_array();

        $this->db->close();*/
		$temp = explode('@', $email);
		$this->db->select( 'name' );
		$this->db->from( 'master.dbo.sysdatabases' );
		$this->db->where( "name!='master' and name!='msdb' and name!='model' and name='$temp[1]'" );
		$query = $this->db->get();
		$database= $query->result();
		if(!$database[0]->name==''){

        $config['hostname'] = "192.168.176.35\SQLEXPRESS";;
        $config['username'] = "ikworx";
        $config['password'] ='Xibelani@54';
        $config['database'] = $database[0]->name;
        $config['dbdriver'] = "sql";
        $config['dbprefix'] = "";
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = "";
        $config['char_set'] = "utf8";
        $config['dbcollat'] = "utf8_general_ci";
        return $config;
		}
		else{
			$_SESSION['error']='database not available';
			exit();
		}
    }
} 
?>