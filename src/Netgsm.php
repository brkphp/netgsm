<?php namespace Brkphp\Netgsm;

class Netgsm {


    public  $dizi = array();
    private $netGsmParameters = array(
      'uniqid','date','dialed','caller','duration' , 'direction' , 'file'
    );

    function xmlGenerator($headParameters = "",$bodyParameters = ""){
       return $xml="<?xml version='1.0' encoding='utf-8' ?>
			<mainbody>
			<header>
                <company>Netgsm</company>
				<usercode>".config('netgsm.username')."</usercode>
				<password>".config('netgsm.password')."</password>
				<version>3</version>
				".$headParameters."
			</header>
			<body>
			    ".$bodyParameters."
            </body>
			</mainbody>";
    }


    /**
     * @param $response
     * @return array
     */
    function jsonParse($response){
        $explodeResponse = explode('<br/>',$response);
        $numItems = count($explodeResponse);
        $i = 0;
        foreach($explodeResponse as $key => $gel){
            if(++$i !== $numItems) {
                $insideExplode = explode('|',$gel);
                $inside = array();
                foreach ($insideExplode as $insideKey => $item){

                    if(config('netgsm.check_duration') == 0){
                        if(substr_count($insideExplode[4],"0") > 5){
                            unset($explodeResponse[$key]);
                            break;
                        }
                    }
                    if(config('netgsm.check_file') != 1){
                        if(empty(trim($insideExplode[6]))){
                            unset($explodeResponse[$key]);
                            break;
                        }
                    }
                    $inside[$this->netGsmParameters[$insideKey]] = trim($item);
                }
                $this->dizi[] = $inside;
            }
        }
        $this->dizi = array_values(array_filter($this->dizi));
        return $this->dizi;
    }

    function checkError($response){
        if(strlen($response) <= 3){
            if($response <= 100 and isset($response) != true){
                return [
                    'status' => $response,
                    'message' => trans('netgsm::santral.'.$response)
                ];
            }else
                return ['status' => 120 ,'message'=>trans("netgsm::santral.120",["code" => $response])];
        }
        return true;

    }


    function _do($postAddress,$xmlData)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$postAddress);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
        $result = curl_exec($ch);
        if($this->checkError($result) == true){
            return $result;
        }
    }


}