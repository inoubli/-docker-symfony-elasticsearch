<?php

namespace App\Model;


class CommandeSearch {

    protected $ref;

    // begin of commande range
    protected $dateFrom;

    // end of commande range
    protected $dateTo;
    
    public function __construct()
    {
        // initialise the dateFrom to "one month ago", and the dateTo to "today"
        $date = new \DateTime();
        $month = new \DateInterval('P1Y');
        $date->sub($month);
        $date->setTime('00','00','00');

        $this->dateFrom = $date;
        $this->dateTo = new \DateTime();
        $this->dateTo->setTime('23','59','59');
    }



    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    public function setDateFrom($dateFrom)
    {
        if($dateFrom != ""){
            $dateFrom->setTime('00','00','00');
            $this->dateFrom = $dateFrom;
        }

        return $this;
    }



    public function getDateTo()
    {
        return $this->dateTo;
    }

    public function setDateTo($dateTo)
    {
        if($dateTo != ""){
            $dateTo->setTime('23','59','59');
            $this->dateTo = $dateTo;
        }

        return $this;
    }



    public function clearDates(){
        $this->dateTo = null;
        $this->dateFrom = null;
    }




    public function getRef()
    {
        return $this->ref;
    }

    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }



   

}