<?php
namespace PhpCommonUtil\Util;


/*
 * Copyright 2002-2013 the original author or authors.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */
 
 
 
/**
 * Assertion utility class that assists in validating arguments.
 * Useful for identifying programmer errors early and clearly at runtime.
 *
 * <p>For example, if the contract of a public method states it does not
 * allow {@code null} arguments, Assert can be used to validate that
 * contract. Doing this clearly indicates a contract violation when it
 * occurs and protects the class's invariants.
 *
 * <p>Typically used to validate method arguments rather than configuration
 * properties, to check for cases that are usually programmer errors rather than
 * configuration errors. In contrast to config initialization code, there is
 * usally no point in falling back to defaults in such methods.
 *
 * <p>This class is similar to JUnit's assertion library. If an argument value is
 * deemed invalid, an {@link \InvalidArgumentException} is thrown (typically).
 * For example:
 *
 * <pre class="code">
 * Assert::notNull(clazz, "The class must not be null");
 * Assert::isTrue($i > 0, "The value must be greater than zero");</pre>
 *
 * @author Siwapun Mapkuff Siwaporn
 */
class Assert
{
    
    /**
     * 
     * @param boolean $expression An expression to test.
     * @param string $message Message string to be set into exception.
     * @throws \InvalidArgumentException
     */
    public static function isTrue($expression, $message = '[Assertion failed] - this expression must be true'){
        if ( is_bool($expression) ){
            if ( !$expression ) {
                throw new \InvalidArgumentException($message);
            }
        }else {
            throw new \InvalidArgumentException('$expression must be boolean while calling Assert::isTrue()');
        }
    }
    
    /**
     * 
     * @param null $object
     * @param string $message Message string to be set into exception.
     * @throws \InvalidArgumentException
     */
    public static function isNull($object, $message = '[Assertion failed] - the object argument must be null'){
        if( !is_null($object) ){
            throw new \InvalidArgumentException($message);
        }
    }
    
    /**
     * 
     * @param mixed $object
     * @param string $message Message string to be set into exception.
     * @throws \InvalidArgumentException
     */
    public static function notNull($object, $message = '[Assertion failed] - the object argument must be null'){
        if( is_null($object) ){
            throw new \InvalidArgumentException($message);
        }
    }
    
    /**
     * To check if a string must contains some character.
     * @param string $text String to test
     * @param string $message Message string to be set into exception.
     * @throws \InvalidArgumentException
     */
    public static function hasLength($text, $message = '[Assertion failed] - this String argument must have length; it must not be null or empty'){
        if ( is_null($text) || is_string($text)){
            if ( is_null($text) || strlen($text) == 0 ) {
                throw new \InvalidArgumentException($message);
            }
        }else{
            throw new \InvalidArgumentException('$text must be null or string while calling Assert::hasLength()');
        }
    }
    
    /**
     * To check if collection is not empty.
     * @param $arrayOrCountable array|\Countable  array or countable object to test
     * @param $message string Message string to be set into exception.
     * @throws \InvalidArgumentException
     */
    public static function notEmpty($arrayOrCountable, $message = '[Assertion failed] - this array or Countable must not be empty: it must contain at least 1 element'){
        if(is_array($arrayOrCountable) || ( is_object($arrayOrCountable) && $arrayOrCountable instanceof \Countable) ){
            if(count($arrayOrCountable) == 0){
                throw new \InvalidArgumentException($message);
            }
        }else{
            throw new \InvalidArgumentException('$arrayOrCountabe must be array or instanceof Countable interfaceg while calling Assert::notEmpty()');
        }
    }
    
    /**
     * To check if a object is instance of a given class or not
     * @param $type string|\ReflectionClass
     * @param $object mixed
     * @param $message string Message string to be set into exception.
     * @throws \InvalidArgumentException
     */
    public static function isInstanceOf($type, $object, $message = '')
    {
        $type = $type instanceof \ReflectionClass ? $type->getName() : $type;
        self::hasLength($type, 'Type to check against must not be null');
        
        $objectClass = is_object($object) ? get_class($object) : 'null';
        $message = strlen($message) > 0 ? $message : 'Object of class [' . $objectClass  .  '] must be instance of ' . $type;
        
        if (is_object($object)) {
            $objectClassRefelction = new \ReflectionClass($objectClass);
            self::isAssignable($type, $objectClassRefelction, $message);
        }else{
            throw new \InvalidArgumentException($message);
        }
    }
    
    /**
     * To check if one class is subtype of another class or not.
     * @param $superType string|\ReflectionClass A class name or ReflectionClass of super type you want to test.
     * @param $subType string|\ReflectionClass   A class name or ReflectionClass of sub type you want to test.
     * @param $message string Message string to be set into exception.
     * @throws \InvalidArgumentException
     */
    public static function isAssignable($superType, $subType, $message = '')
    {
        
        if (is_string($subType)){
            self::hasLength($subType, 'SubType to check against must not be an empty string');
        }else{
            self::isTrue($subType instanceof  \ReflectionClass, 'SubType to check against must be class name or ReflectionClass');
        }
        if (is_string($superType)){
            self::hasLength($superType, 'SuperType to check against must not be an empty string');
        }else{
            self::isTrue($superType instanceof  \ReflectionClass, 'SuperType to check against must be class name or ReflcteionClass');
        }

        $subType = $subType instanceof \ReflectionClass ? $subType : $subType->getName();
        $superType = $superType instanceof \ReflectionClass ? $superType->getName() : $superType;
        /* @var $subType \ReflectionClass */
        /* @var $superType \ReflectionClass */

        if ( !( $superType===$subType->getName() || $subType->isSubclassOf($superType) ) ){
            throw new \InvalidArgumentException($message . $subType->getName() . " is not assignable to " . $superType->getName());
        }
        
    }
    
    /**
     * to check $str is string or null
     * @param null||string $str
     */
    public static function isStringOrNull($str){
        if( !is_null($str) && !is_string($str) ){
            throw new \InvalidArgumentException('Parameter $str must be null or string.');
        }
    }
    
    
}