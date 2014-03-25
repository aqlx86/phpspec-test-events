<?php

class EventsCal
{
	private $events = array();

	private $error = null;

    public function create($date, $event)
    {  		
    	if($this->is_valid_date($date) === false) 
    	{
    		$this->error = 'Invalid Date.';
    		return false;
    	}

    	if($this->has_event($date))
    		return false;

        $this->events[$date] = $event;

    	return $this->has_event($date);
    }

    public function has_event($date)
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

    private function is_valid_date($date)
    {
    	$format = 'Y-m-d';

    	$date_object = DateTime::createFromFormat($format, $date);

    	return $date_object && $date_object->format($format) == $date;
    }


    
}
