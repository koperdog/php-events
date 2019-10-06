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

namespace koperdog\phpevents\base;

/**
 * Object-level event-handling component interface
 * 
 * @author Koperdog <koperdog@github.com>
 * @version 1.0
 */
interface Component {
    
    /**
     * Attaches an event handler
     * 
     * @param string $name
     * @param callable $handler
     * @param bool $append
     */
    public function on(string $name, callable $handler, bool $append = true);
    
    /**
     * Deattaches an event handler 
     * 
     * @param string $name
     * @param type $handler
     * @return bool
     */
    public function off(string $name, $handler = null): bool;
    
    /**
     * Deattaches all event handlers
     */
    public function offAll();
    
    /**
     * Trigger an event by name
     * 
     * @param string $name
     */
    public function trigger(string $name);
    
    /**
     * Checks if a handler exists for the specified event
     * 
     * @param string $name
     * @return bool
     */
    public function hasHandler(string $name): bool;
}
