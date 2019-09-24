# php-events
Trigger and listen to events

## Requirement
This package requires PHP 7.0 or later.

## Introduction
> You can implements **\base\Component** or extends **EventComponent** for creat your Component

## Example
Class level events:
```php
const EVENT_SAVE = "save";
$callback = function(){ print "Save event trigger"; };
Event::on(EVENT_SAVE, $callback); # Adds the handler 
Event::on(EVENT_SAVE, function(){ print "Second hadnler for the save event"; }, false); # Will be processed first
...
Event::trigger(EVENT_SAVE);
# print "Second hadnler for the save event"
# print "Save event trigger"

Event::off(EVENT_SAVE, $callback); # Deattaches the handler $callback from the save event
...
Event::trigger(EVENT_SAVE); # print "Second hadnler for the save event"
```

Object level events:
```php
const EVENT_SAVE = "save";
$callback = function(){ print "Second hadnler for the save event"; };

$component = new EventComponent();
$component->on(EVENT_SAVE, function(){ print "Save event trigger"; }); # Adds the handler 
$component->on(EVENT_SAVE, $callback, false); # Will be processed first
...
$component->tigger(EVENT_SAVE); # print "Save event trigger"
# print "Second hadnler for the save event"
# print "Save event trigger"


$component->off(EVENT_SAVE, $callback); # Deattaches the handler $callback from the save event
...
$component->trigger(EVENT_SAVE); # print "Save event trigger"
```
