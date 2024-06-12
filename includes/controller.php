<?php 

	$username = "root";
    $password = "root";
    $database = "final_bbp";
    $hostname = "localhost:8889";
    $con = mysqli_connect($hostname,$username,$password,$database);

    $rg = new lsp();

    class lsp{

        public function login($username,$password){
            global $con;
            
            $sql = "SELECT * FROM table_user WHERE username ='$username'";
            $query = mysqli_query($con,$sql);
            $rows  = mysqli_num_rows($query);
            $assoc = mysqli_fetch_assoc($query);
            if($rows > 0){
                if($assoc['password'] == $password){
                    return ['response'=>'positive','alert'=>'Berhasil Login','level'=>$assoc['level']];
                }else{
                    return ['response'=>'negative','alert'=>'Password Salah'];    
                }
            }else{
                
                return ['response'=>'negative','alert'=>'Username atau Password Salah'];
            }
        }

        public function redirect($redirect)
        {
            return ['response'=>'positive','alert'=>'Login Berhasil','redirect'=>$redirect];   
        }

        public function logout(){
            session_destroy();
            header("Location:index.php");
        }

        public function logout2(){
            session_destroy();
            header("Location:index.php");
        }

         public function selectSum($table,$namaField){
            global $con;
            $sql = "SELECT SUM($namaField) as sum FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

         public function selectSumWhere($table,$namaField,$where){
            global $con;
            $sql = "SELECT SUM($namaField) as sum FROM $table WHERE $where";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectCount($table,$namaField){
            global $con;
            $sql = "SELECT COUNT($namaField) as count FROM $table";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function selectBetween($table,$whereparam,$param,$param1){
            global $con;
            $sql = "SELECT * FROM $table WHERE $whereparam BETWEEN '$param' AND '$param1'";
            $query = mysqli_query($con,$sql);

            $sqls = "SELECT SUM(stok_barang) as count FROM $table WHERE $whereparam BETWEEN '$param' AND '$param1'";
            $querys = mysqli_query($con,$sqls);
            $assocs = mysqli_fetch_assoc($querys);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return ['data'=>$data,'jumlah'=>$assocs];
        }

        public function AuthUser($sessionUser){
            global $con;
            $sql = "SELECT * FROM table_user WHERE username = '$sessionUser'";
            $query = mysqli_query($con,$sql);
            $bigData = mysqli_fetch_assoc($query);
            return $bigData;
        }

        public function autokode($table,$field,$pre){
            global $con;
            $sqlc   = "SELECT COUNT($field) as jumlah FROM $table";
            $querys = mysqli_query($con,$sqlc);
            $number = mysqli_fetch_assoc($querys);
            if($number['jumlah'] > 0){
                $sql    = "SELECT MAX($field) as kode FROM $table";
                $query  = mysqli_query($con,$sql);
                $number = mysqli_fetch_assoc($query);
                $strnum = substr($number['kode'], 2,3);
                $strnum = $strnum + 1;
                if(strlen($strnum) == 3){ 
                    $kode = $pre.$strnum;
                }else if(strlen($strnum) == 2){ 
                    $kode = $pre."0".$strnum;
                }else if(strlen($strnum) == 1){ 
                    $kode = $pre."00".$strnum;
                }
            }else{
                $kode = $pre."001";
            }

            return $kode;
        }

        public function querySelect($sql){
            global $con;
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }

        public function selectWhere($table,$where,$whereValues){
            global $con;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function edit($table,$where,$whereValues){
            global $con;
            $sql = "SELECT * FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }  

        public function getCountRows($table){
            global $con;
            $sql   = "SELECT * FROM $table";
            $query = mysqli_query($con,$sql);
            $rows  = mysqli_num_rows($query);
            return $rows;
        }
        
        public function sessionCheck(){
            if(!isset($_SESSION['username'])){
                
                return "false";
            }else{
                
                return "true";
            }
        }

    	public function insert($table, $values, $redirect){
    		global $con;
    		$sql   = "INSERT INTO $table VALUES($values)";
            $query = mysqli_query($con,$sql);
            if($query){
                return ['response'=>'positive','alert'=>'Berhasil Menambahkan Data','redirect'=>$redirect];
            }else{
                echo mysqli_error($con);
                return ['response'=>'negative','alert'=>'Gagal Menambahkan Data'];
            }
    	}

        public function update($table,$values,$where,$whereValues,$redirect){
            global $con;
            $sql   = "UPDATE $table SET $values WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
                if($query){
                    return ['response'=>'positive','alert'=>'Berhasil update data','redirect'=>$redirect];
                }else{
                    echo mysqli_error($con);
                    return ['response'=>'negative','alert'=>'Gagaal Update Data'];
                }
        }   

    	public function select($table){
            global $con;
            $sql = "SELECT * FROM $table";
            $query = mysqli_query($con,$sql);
            $data = [];
            while($bigData = mysqli_fetch_assoc($query)){
                $data[] = $bigData;
            }
            return $data;
        }

        public function selectCountWhere($table,$namaField,$where){
            global $con;
            $sql = "SELECT COUNT($namaField) as count FROM $table WHERE $where";
            $query = mysqli_query($con,$sql);
            return $data = mysqli_fetch_assoc($query);
        }

        public function validateHtml($field){ 
            $field = htmlspecialchars($field);
            return $field;
        }

        public function delete($table,$where,$whereValues,$redirect){
            global $con;
            $sql = "DELETE FROM $table WHERE $where = '$whereValues'";
            $query = mysqli_query($con,$sql);
            if($query){
                return ['response'=>'positive','alert'=>'Berhasil Menghapus Data','redirect'=>$redirect];
            }else{
                echo mysqli_error($con);
                return ['response'=>'negative','alert'=>'Gagal Menghapus Data'];
            }
        }

    }

 ?>