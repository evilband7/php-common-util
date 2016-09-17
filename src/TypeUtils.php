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
     * @param string|ReflectionClass $lhsType the target type
     * @param string|ReflectionClass $rhsType the value type that should be assigned to the target type
     * @return boolean true if $rhs is assignable to $lhs
     */
    public static function isAssignable($lhsType, $rhsType) {
        if( is_string($lhsType) && is_string($rhsType) && $lhsType===$rhsType){
            return true;
        }
        $rhsType = $rhsType instanceof \ReflectionClass ? $rhsType : new \ReflectionClass($rhsType);
        $lhsType = $lhsType instanceof  \ReflectionClass ? $lhsType : new \ReflectionClass($lhsType);

        /* @var $rhsType \ReflectionClass */
        /* @var $lhsType \ReflectionClass */
        return $lhsType->getName() === $rhsType->getName() ||  $rhsType->isSubclassOf($lhsType);
    }
}