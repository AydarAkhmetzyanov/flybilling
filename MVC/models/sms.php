<?php

class SMS extends Model
{

    public static function get($data){
        //possible options id,from,to,client_ID,timezone,service_ID,signature,order,offset,limit,group[day,hour,month,year]
        $tsql="SELECT ";
        if(!isset($data['group'])){
            $tsql.='*';
            if(isset($data['timezone'])){
                $tsql.=", dateadd(minute,$data[timezone]*60,CAST([timestamp] AS smalldatetime)) as [localtimestamp]";
            } else {
                $tsql.=", [timestamp] as [localtimestamp]";
            }
        } else {
            switch ($data['group']) {
                case 'hour':
                    $grouppart="CONVERT(CHAR(13), dateadd(minute,$data[timezone]*60,CAST([timestamp] AS smalldatetime)), 120)";
                    break;
                case 'day':
                    $grouppart="CONVERT(CHAR(10), dateadd(minute,$data[timezone]*60,CAST([timestamp] AS smalldatetime)), 120)";
                    break;
                case 'month':
                    $grouppart="CONVERT(CHAR(7), dateadd(minute,$data[timezone]*60,CAST([timestamp] AS smalldatetime)), 120)";
                    break;
                case 'year':
                    $grouppart="CONVERT(CHAR(4), dateadd(minute,$data[timezone]*60,CAST([timestamp] AS smalldatetime)), 120)";
                    break;
            }
            $tsql.=$grouppart." [localtimestamp],sum([external_share]) AS [external_share],sum([client_share]) AS [client_share],count([ID]) AS [ID] ";
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
                $tsql.=" AND dateadd(minute,$data[timezone]*60,[timestamp])>=CAST(:from AS smalldatetime)";
            } else {
                $tsql.=" AND [timestamp]>=CAST(:from AS smalldatetime)";
            }
            $params['from']=$data['from'];
        }
        if(isset($data['to'])){
            if(isset($data['timezone'])){
                $tsql.=" AND dateadd(minute,$data[timezone]*60,[timestamp])<=CAST(:to AS smalldatetime)";
            } else {
                $tsql.=" AND [timestamp]>=CAST(:to AS smalldatetime)";
            }
            $params['to']=$data['to'];
        }
        if(isset($data['group'])){
            $tsql.=" GROUP BY ".$grouppart;
        }
        if(isset($data['order'])){
            $tsql.=" ORDER BY [$data[order]] DESC";
        } else {
            $tsql.=' ORDER BY [localtimestamp] DESC';
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
