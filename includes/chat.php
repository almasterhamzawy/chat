<?php

class chat {

    private $connection;

    public function __construct(){

        $this->connection = new PDO("mysql:host=".HOST.";dbname=".DBNAME,USER,PASS);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }

    public function addMessage($name,$message){

        $sql = "INSERT INTO `chat`(`name`, `message`) VALUES (:name,:message)";

        try{
            $data = $this->connection->prepare($sql);
            $data->bindParam(':name',$name,PDO::PARAM_STR);
            $data->bindParam(':message',$message,PDO::PARAM_STR);
            $data->execute();

            if($data->rowCount()>0){

                return true;

            }else{

                return false;
            }

        }catch (PDOException $e){
            echo $e->getMessage();
        }


    }

    public function getMessages($extra = ''){

        try{

            $sql = "SELECT * FROM `chat` $extra" ;

            $data = $this->connection->prepare($sql);

            $data->execute();

            $message = array();

            if($data->rowCount()>0){

                while($row = $data->fetch(PDO::FETCH_ASSOC)){

                    $message[] = $row;

                }
                return $message;
            }
        }catch (PDOException $e){

            echo $e->getMessage();
        }


    }


}