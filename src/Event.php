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

namespace koperdog\phpevent;

/**
 * Description of Event
 *
 * @author Koperdog <koperdog@github.com>
 */
class Event implements EventInterface{
    
    private static $handlers = [];
    
    /**
     * Attaches an event handler
     * 
     * @param string $name
     * @param callable $handler
     * @param bool $append
     * @return int
     */
    public static function on(string $name, callable $handler, bool $append = true){
        if($append){
            self::$handlers[$name][] = $handler;
        }
        else{
            array_unshift(self::$handlers[$name], $handler);
        }
    }
    
    /**
     * Deattaches an event handler 
     * 
     * @param string $name
     * @param type $handler
     * @return bool
     */
    public static function off(string $name, $handler = null): bool {
        if(!isset(self::$handlers[$name])) return false;

        if($handler === null){
            unset(self::$handlers[$name]);
        }
        else if($handler !== null && self::$handlers[$name] === $handler){
            foreach(self::$handler[$name] as $key => $h){
                if($h === $handler){
                    unset(self::$handlers[$name][$key]);
                }
            }
        }
        
        self::$handlers = array_values(self::$handlers);
        return true;
    }
    
    /**
     * Deattaches all event handlers
     */
    public static function offAll() {
        self::$handlers = [];
    }
    
    /**
     * Trigger an event by name
     * 
     * @param string $name
     */
    public static function trigger(string $name) {
        if(isset(self::$handlers[$name])){
            foreach(self::$handlers[$name] as $handler){
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
    public static function hasHandler(string $name): bool {
        return isset(self::$handlers[$name]);
    }
    
    /**
     * Close magic methods
     */
    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}
}
