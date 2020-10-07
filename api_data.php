<?php
$con=mysqli_connect("localhost","api_user","api_user","js_ajax_example");
$GLOBALS['con']=$con;
function getStates($id=NULL){

    if($id==NULL){
        $query=mysqli_query($GLOBALS['con'],"select * from state_table");
        $all_data=array();

        while($row=mysqli_fetch_assoc($query)){
            array_push($all_data,$row);
        }

        return $all_data;
    }
    else{
            $query=mysqli_query($GLOBALS['con'],"select * from state_table where id='".$id."'");
            $all_data=array();
    
            while($row=mysqli_fetch_assoc($query)){
                array_push($all_data,$row);
            }
    
            return $all_data;
        
    }
}

function getDistrict($state_id=NULL){
    if($state_id==NULL){
        $query=mysqli_query($GLOBALS['con'],"select * from district_table");
        $all_data=array();

        while($row=mysqli_fetch_assoc($query)){
            array_push($all_data,$row);
        }

        return $all_data;
    }
    else{
            $query=mysqli_query($GLOBALS['con'],"select * from district_table where state_id='".$state_id."'");
            $all_data=array();
    
            while($row=mysqli_fetch_assoc($query)){
                array_push($all_data,$row);
            }
    
            return $all_data;
        
    }
}

function getAddress($district_id=NULL){
    if($district_id==NULL){
        $query=mysqli_query($GLOBALS['con'],"select * from address_table");
        $all_data=array();

        while($row=mysqli_fetch_assoc($query)){
            array_push($all_data,$row);
        }

        return $all_data;
    }
    else{
            $query=mysqli_query($GLOBALS['con'],"select * from address_table where district='".$district_id."'");
            $all_data=array();
    
            while($row=mysqli_fetch_assoc($query)){
                array_push($all_data,$row);
            }
    
            return $all_data;
        
    }
}

if(isset($_REQUEST['type'])){
    if($_REQUEST['type']=="district"){
        echo json_encode(getDistrict($_REQUEST['state_id']));
    }
    else if($_REQUEST['type']=="address"){
        echo json_encode(getAddress($_REQUEST['district_id']));
    }
}
else{
    echo json_encode(getStates());
}