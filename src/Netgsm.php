<?php namespace Brkphp\Netgsm;

class Netgsm {

    /**
     * @var string
     */
    public $headParameters = "";
    /**
     * @var string
     */
    public $bodyParameters = "";



    /**
     * @param string $headParameters
     * @param string $bodyParameters
     * @return string
     */
    function xmlGenerator(){
       return $xml="<?xml version='1.0' encoding='utf-8' ?>
			<mainbody>
			<header>
               
				<usercode>".config('netgsm.username')."</usercode>
				<password>".config('netgsm.password')."</password>
				
				".$this->headParameters."
			</header>
			<body>
			  		".$this->bodyParameters."
            </body>
			</mainbody>";
    }

    /**
     * @param $key
     * @param $value
     */
    public function addHeadParameter($key, $value){
        $this->headParameters .= sprintf('<%s>%s</%s>', $key,$value,$key);
    }

    /**
     * @param $key
     * @param $value
     */
    public function addBodyParameter($key, $value){
        $this->bodyParameters .= sprintf('<%s>%s</%s>', $key,$value,$key);
    }



    /**
     * @param $response
     * @return array|bool
     */
    function checkError($response){

        if(strlen($response) <= 3 ){

            if(intval($response) <= 100 and intval($response) > 0){
                return [
                    'status' => $response,
                    'message' => trans('netgsm::santral.'.$response)
                ];
            }else
                return ['status' => 120 ,'message'=>trans("netgsm::santral.120",["code" => $response])];
        }

        return true;

    }


    /**
     * @param $postAddress
     * @param $xmlData
     * @return mixed
     */
    function _do($apiUrl, $xmlData)
    {
         $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$apiUrl);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlData);
        $result = curl_exec($ch);

        if (is_array($this->checkError($result))){
              return $this->checkError($result);
        }
        return $result;
    }


}
