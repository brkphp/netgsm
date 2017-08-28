<?php namespace Brkphp\Netgsm;

class Santral extends Netgsm
{


    /**
     * @var string
     */
    public $headParameters = "";
    /**
     * @var string
     */
    public $bodyParameters = "";
    /**
     * @var null
     */
    public $startDate = null;
    /**
     * @var null
     */
    public $stopDate = null;


    /**
     * Santral constructor.
     */
    function __construct()
    {
        $this->startDate(date('dmY0000'));
        $this->stopDate(date('dmY2359'));
        return $this->headParameters;
    }


    /**
     * @param null $startDate
     *
     */
    public function startDate($startDate)
    {
        $this->headParameters = null;
        $this->headParameters .= sprintf('<startdate>%s</startdate>', $startDate);
        $this->startDate = $startDate;
    }


    /**
     * @param null $stopDate
     */
    public function stopDate($stopDate)
    {
        $this->headParameters .= sprintf('<stopdate>%s</stopdate>', $stopDate);
         $this->stopDate = $stopDate;
    }

    /**
     * @param $uniq
     */
    public function uniqId($uniq){
        $this->bodyParameters .= sprintf('<uniqueid>%s</uniqueid>', $uniq);
    }

    /**
     * @param $phone
     */
    public function phone($phone){
        $this->bodyParameters .= sprintf('<no>%s</no>', $phone);

    }

    /**
     * @param int $type in 1-4 default 2 recommend 2
     * @return array|string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function dateQuery($type = 2)
    {
        $this->headParameters .= "<tip>$type</tip>";
        $response = $this->_do(config('netgsm.santral_api_Url'),$this->xmlGenerator($this->headParameters));
        return $this->jsonParse($response);
    }

    /**
     * @return array
     */
    public function sendQuery(){
        $response = $this->_do(config('netgsm.santral_api_Url'),$this->xmlGenerator($this->bodyParameters));
        return $this->jsonParse($response);
    }




}