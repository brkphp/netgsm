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
     * @var array
     */
    public  $dizi = array();
    private $netGsmParameters = array(
        'uniqid','date','dialed','caller','duration' , 'direction' , 'file'
    );

    function __construct()
    {
        $this->addHeadParameter('company','Netgsm');
        $this->addHeadParameter('version',3);
    }

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
     return   $response = $this->_do(config('netgsm.santral_api_url'),$this->xmlGenerator());
        return $this->jsonParse($response);
    }

    /**
     * @return array
     */
    public function sendQuery(){
        $response = $this->_do(config('netgsm.santral_api_url'),$this->xmlGenerator());
        return $this->jsonParse($response);
    }

    public function addTodayParameter(){
        $this->addHeadParameter('startdate',date('dmY0000'));
        $this->addHeadParameter('stopdate',date('dmY2359'));
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

}