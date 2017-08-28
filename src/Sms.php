<?php namespace Brkphp\Netgsm;

class Sms extends Netgsm
{
    function __construct()
    {
        $this->addHeadParameter('msgheader',config('netgsm.title'));
        $this->addHeadParameter('type' , '1:n');
        $this->addHeadParameter('startdate' , '');
        $this->addHeadParameter('stopdate' , '');
        if(config('netgsm.tr')){
            $this->headParameters .= "<company dil='TR'>Netgsm</company>";
        }else{
            $this->headParameters .= "<company>Netgsm</company>";
        }
    }

    public function phone($phone){
        $this->addBodyParameter('no',$phone);
    }

    public function message($message){
        if(!config('netgsm.tr')){
            $message = $this->replace_tr($message);
        }
        $this->addBodyParameter('msg',sprintf("<![CDATA[%s]]>",$message));
    }

    public function send(){
       return $this->_do(config('netgsm.sms_api_url'),$this->xmlGenerator());
    }

    public function replace_tr($text)
    {
        $text = trim($text);
        $search = array('Ç', 'ç', 'Ğ', 'ğ', 'ı', 'İ', 'Ö', 'ö', 'Ş', 'ş', 'Ü', 'ü');
        $replace = array('C', 'c', 'G', 'g', 'i', 'I', 'O', 'o', 'S', 's', 'U', 'u');
        $new_text = str_replace($search, $replace, $text);
        return $new_text;
    }



}