<?php
namespace PhpCommonUtil\Util;


/*
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

/**
 * 
 * @author Mapkuff 
 *
 */
class TypeUtils
{
    /**
     * Check if the right-hand side type may be assigned to the left-hand side
     * type following the Java generics rules.
     * @param string|ReflectionClass $toClass the target type
     * @param string|ReflectionClass $fromClass the value type that should be assigned to the target type
     * @return boolean true if $fromClass is assignable to $toClass
     */
    public static function isAssignable($fromClass, $toClass) {
        if( is_string($fromClass) && is_string($toClass) && $fromClass===$toClass){
            return true;
        }
        $toClass = $toClass instanceof \ReflectionClass ? $toClass : new \ReflectionClass($toClass);
        $fromClass = $fromClass instanceof  \ReflectionClass ? $fromClass : new \ReflectionClass($fromClass);

        /* @var $toClass \ReflectionClass */
        /* @var $fromClass \ReflectionClass */
        return $fromClass->getName() === $toClass->getName() ||  $toClass->isSubclassOf($fromClass);
    }
}