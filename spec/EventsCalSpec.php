<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventsCalSpec extends ObjectBehavior
{
    public function it_can_create_event()
    {
    	$date = '2014-03-01';
    	$event = 'Some Event';

    	return $this->create($date, $event)->shouldReturn(true);
    }

    public function it_should_not_create_existing_dates()
    {
		$this->create('2014-03-01', 'Some Event 1');
    	$this->create('2014-03-01', 'Some Event 2')->shouldReturn(false);
    }

    public function it_should_accept_valid_dates_only()
    {
    	$this->create('2014-03-01', 'Some Event 1')->shouldReturn(true);
    }

    public function it_should_display_invalid_date_message()
    {
    	$this->create('2014-03-100', 'Some Event 1');
    	$this->error()->shouldReturn('Invalid Date.');
    }

	public function it_has_event_on_this_date()
    {
    	$date = '2014-03-01';
    	$event = 'Some Event';

    	$this->create($date, $event);
    	
    	$this->hasEvent($date)->shouldReturn(true);
    }

    public function it_has_no_event_on_this_date()
    {
    	$date = '2014-03-01';

    	$this->hasEvent($date)->shouldReturn(false);
    }

    public function it_should_have_empty_events()
    {
    	$this->events()->shouldHaveCount(0);
    }

    public function it_should_have_more_than_one_events()
    {
    	$this->create('2014-03-01', 'Some Event 1');
    	$this->create('2014-03-02', 'Some Event 2');

    	$this->events()->shouldHaveCount(2);
    }

    public function it_should_return_event_name()
    {
    	$this->create('2014-03-01', 'Some Event 1');
    	$this->create('2014-03-02', 'Some Event 2');
    	$this->create('2014-03-03', 'Some Event 3');

    	$date = '2014-03-02';

    	$this->event($date)->shouldBeEqualTo('Some Event 2');
    }

}
