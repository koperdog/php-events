<?php

/*
 * Copyright 2019 Koperdog <koperdog@github.com>.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace koperdog\phpevents;

/**
 * Implementation of handling and trigger events of the object level
 *
 * @author Koperdog <koperdog@github.com>
 * @version 1.0
 */
class EventComponent implements base\Component{
    /**
     *
     * @var array 
     */
    private $handlers = [];
    
    /**
     * Attaches an event handler
     * 
     * @param string $name
     * @param callable $handler
     * @param bool $append
     */
    public function on(string $name, callable $handler, bool $append = true){
        if($append){
            $this->handlers[$name][] = $handler;
        }
        else{
            array_unshift($this->handlers[$name], $handler);
        }
    }
    
    /**
     * Deattaches an event handler 
     * 
     * @param string $name
     * @param type $handler
     * @return bool
     */
    public function off(string $name, $handler = null): bool {
        if(!isset($this->handlers[$name])) return false;

        if($handler === null){
            unset($this->handlers[$name]);
        }
        else if($handler !== null && $this->handlers[$name] === $handler){
            foreach($this->handler[$name] as $key => $h){
                if($h === $handler){
                    unset($this->handlers[$name][$key]);
                }
            }
        }
        
        $this->handlers = array_values($this->handlers);
        return true;
    }
    
    /**
     * Deattaches all event handlers
     */
    public function offAll() {
        $this->handlers = [];
    }
    
    /**
     * Trigger an event by name
     * 
     * @param string $name
     */
    public function trigger(string $name) {
        if(isset($this->handlers[$name])){
            foreach($this->handlers[$name] as $handler){
                call_user_func($handler);
            }
        }
    }
    
    /**
     * Checks if a handler exists for the specified event
     * 
     * @param string $name
     * @return bool
     */
    public function hasHandler(string $name): bool {
        return isset($this->handlers[$name]);
    }
}
