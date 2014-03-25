<?php

class EventsCal
{
	private $events = array();

	private $error = null;

    public function create($date, $event)
    {  		
    	if($this->isValidDate($date) === false) 
    	{
    		$this->error = 'Invalid Date.';
    		return false;
    	}

    	if($this->hasEvent($date))
    		return false;

        $this->events[$date] = $event;

    	return $this->hasEvent($date);
    }

    public function hasEvent($date)
    {
    	return isset($this->events[$date]);
    }

    public function events()
    {
    	return $this->events;
    }

    public function event($date)
    {
        return $this->events[$date];
    }

    public function error()
    {
    	return $this->error;
    }

    private function isValidDate($date)
    {
    	$format = 'Y-m-d';

    	$dateObject = DateTime::createFromFormat($format, $date);

    	return $dateObject && $dateObject->format($format) == $date;
    }


    
}
