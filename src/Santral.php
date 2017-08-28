<?php namespace Brkphp\Netgsm;

class Santral extends Netgsm
{

    /**
     * @var null
     */
    public $startDate = null;
    /**
     * @var null
     */
    public $stopDate = null;



    /**
     * @param null $startDate
     *
     */
    public function startDate($startDate)
    {
        $this->headParameters = null;
        $this->addHeadParameter('startdate',$startDate);
        $this->startDate = $startDate;
    }

    /**
     * @param null $stopDate
     */
    public function stopDate($stopDate)
    {
       $this->addHeadParameter('stopdate',$stopDate);
       $this->stopDate = $stopDate;
    }

    /**
     * @param $uniq
     */
    public function uniqId($uniq){
        $this->addBodyParameter('uniqueid',$uniq);
    }

    /**
     * @param $phone
     */
    public function phone($phone){
        $this->addBodyParameter('no',$phone);
    }

    /**
     * @param int $type in 1-4 default 2 recommend 2
     * @return array|string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function dateQuery($type = 2)
    {
        if($this->headParameters == ""){
            $this->addTodayParameter();
        }
        $this->addHeadParameter('tip',$type);
     return   $response = $this->_do(config('netgsm.santral_api_Url'),$this->xmlGenerator());
        return $this->jsonParse($response);
    }

    /**
     * @return array
     */
    public function sendQuery(){
        $response = $this->_do(config('netgsm.santral_api_Url'),$this->xmlGenerator());
        return $this->jsonParse($response);
    }

    public function addTodayParameter(){
        $this->addHeadParameter('startdate',date('dmY0000'));
        $this->addHeadParameter('stopdate',date('dmY2359'));

    }



}