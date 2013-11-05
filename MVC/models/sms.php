<?php

class SMS extends Model
{

    public static function get($data){
        print_r($data);
        //possible options id,from,to,client_ID,timezone,service_ID,signature,order,offset,limit
        $params=array();
        $tsql="SELECT *";
        if(isset($data['timezone'])){
            $tsql.=", dateadd(hour,$data[timezone],CAST([timestamp] AS datetime)) as [localtimestamp]";
        } else {
            $tsql.=", [timestamp] as [localtimestamp]";
        }
        $tsql.=" FROM ".SCHEMA.".[SMS] WHERE 1=1 ";
        if(isset($data['ID'])){
            $tsql.=' AND [ID]=:ID';
            $params['ID']=$data['ID'];
        }
        if(isset($data['service_ID'])){
            $tsql.=' AND [service_ID]=:service_ID';
            $params['service_ID']=$data['service_ID'];
        }
        if(isset($data['client_ID'])){
            $tsql.=' AND [client_ID]=:client_ID';
            $params['client_ID']=$data['client_ID'];
        }
        if(isset($data['from'])){
            if(isset($data['timezone'])){
                $tsql.=" AND dateadd(hour,$data[timezone],[timestamp])>=CAST(:from AS datetime)";
            } else {
                $tsql.=" AND [timestamp]>=CAST(:from AS datetime)";
            }
            $params['from']=$data['from'];
        }
        if(isset($data['to'])){
            if(isset($data['timezone'])){
                $tsql.=" AND dateadd(hour,$data[timezone],[timestamp])<=CAST(:to AS datetime)";
            } else {
                $tsql.=" AND [timestamp]>=CAST(:to AS datetime)";
            }
            $params['to']=$data['to'];
        }
        if(isset($data['order'])){
            $tsql.=" ORDER BY [$data[order]]";
        } else {
            $tsql.=' ORDER BY [ID]';
        }
        if(isset($data['offset'])){
            $tsql.=" OFFSET $data[offset] ROW ";
        } else {
            $tsql.=' OFFSET 0 ROW ';
        }
        if(isset($data['limit'])){
            $tsql.=" FETCH NEXT $data[limit] ROW ONLY ";
        } 
        $statement = Database::getInstance()->prepare($tsql);
        try{
            $statement->execute($params);
        } catch(PDOException $e) {
            API_helper::failResponse($e->getMessage().' SQL query: '.$tsql,500); exit();
        }
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($row)>0){
            return $row;
        } else {
            return FALSE;
        }
	}

}
