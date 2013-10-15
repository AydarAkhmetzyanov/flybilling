<?php

class Http_query
{

    public static function sendParamQuery($url,$params) {
        $query=$url;
        $query.='?';
        $query.=http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $query);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public static function sendAsync($url,$params) {
        $post_params = array();
        foreach($params as $k=>$v)
            $post_params[] = "$k=".urlencode($v);
        $post_params = implode('&',$post_params);
        $parts = parse_url($url);
        if(!$fp = fsockopen($parts['host'],isset($parts['port'])?$parts['port']:80))
            return false;
        if(empty($parts['path']))
            $parts['path'] = '/';
        $out = array();
        $out[] = "POST $parts[path]? HTTP/1.1";
        $out[] = "Host: $parts[host]";
        $out[] = "Content-Type: application/x-www-form-urlencoded";
        $out[] = "Content-Length: ".mb_strlen($post_params,'utf-8');
        $out[] = "User-Agent: Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_4; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.127 Safari/533.4";
        $out[] = "Connection: Close";
        $out[] = "\r\n";
        $out = implode("\r\n",$out).$post_params;
        fwrite($fp,$out);
        sleep(1);
        fclose($fp);
        return true;
    }

}

