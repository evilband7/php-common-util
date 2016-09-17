<?php
namespace PhpCommonUtil\Util;

class StringUtils
{

    /**
     * @param $string static
     * @param $suffix string
     * @return bool
     */
    public static function endsWith($string, $suffix) {
        $stringLen = strlen($string);
        $suffixLen = strlen($suffix);
        if ($suffixLen > $stringLen) return false;
        return substr_compare($string, $suffix, $stringLen - $suffixLen, $suffixLen) === 0;
    }
    
    /**
     * Check whether the given String is empty.
     * @param $str string
     * @return bool
     */
    public static function isEmpty($str) {
        Assert::isStringOrNull($str);
        return empty($str);
    }
    
    
    /**
     * Check that the given String is neither null nor of length 0.
     * <pre class="code">
     * StringUtils::hasLength(null) = false
     * StringUtils::hasLength("") = false
     * StringUtils::hasLength(" ") = true
     * StringUtils::hasLength("Hello") = true
     * </pre>
     * @param $str string the string to check (may be null)
     * @return bool true if the given string is not null and has length
     */
    public static function  hasLength($str) {
        Assert::isStringOrNull($str);
        return !(is_null($str) || strlen($str)==0);
    }
    
    
    /**
     * Check whether the given String has actual text.
     * More specifically, returns true if the string not null,
     * its length is greater than 0, and it contains at least one non-whitespace character.
     * <pre class="code">
     * StringUtils::hasText(null) = false
     * StringUtils::hasText("") = false
     * StringUtils::hasText(" ") = false
     * StringUtils::hasText("12345") = true
     * StringUtils::hasText(" 12345 ") = true
     * </pre>
     * @param $str string the string to check (may be null)
     * @return bool true if the givven string is not null,
     * its length is greater than 0, and it does not contain whitespace only
     */
    public static function  hasText($str) {
        if (!self::hasLength($str)) {
            return false;
        }
        foreach (str_split($str) as $char){
            if (!ctype_space($char)){
                return true;
            }
        }
        return false;
    }
    
    
    /**
     * Check whether the given String contains any whitespace characters.
     * @param $str string the String to check (may be null})
     * @return bool true if the CharSequence is not empty and
     * contains at least 1 whitespace character
     */
    public static function containsWhitespace($str) {
        if (!self::hasLength($str)) {
            return false;
        }
        foreach (str_split($str) as $char){
            if (ctype_space($char)){
                return true;
            }
        }
        return false;
    }
    
    
    /**
    * Trim leading and trailing whitespace from the given String.
    * @param $str string the String to check
    * @return string the trimmed String
    */
    public static function  trimWhitespace($str) {
        if (!self::hasLength($str)) {
            return $str;
        }
        return trim($str);
    }
    
    /**
     * Trim <i>all</i> whitespace from the given String:
     * leading, trailing, and in between characters.
     * @param $str string the String to check
     * @return string the trimmed String
     */
    public static function trimAllWhitespace($str) {
        if (!self::hasLength($str)) {
            return $str;
        }
        $result = '';
        foreach (str_split($str) as $char){
            if (!ctype_space($char)){
                $result.=$char;
            }
        }
        return $result;
    }
    
    /**
     * Trim leading whitespace from the given String.
     * @param $str string the String to check
     * @return string the trimmed String
     */
    public static function  trimLeadingWhitespace($str) {
        if (!self::hasLength($str)) {
            return $str;
        }
        return ltrim($str);
    }
    
    
    /**
     * Trim trailing whitespace from the given String.
     * @param $str string the String to check
     * @return string the trimmed String
     */
    public static function  trimTrailingWhitespace($str) {
        if (!self::hasLength($str)) {
            return $str;
        }
        return rtrim($str);
    }
    
    /**
     * Trim all occurrences of the supplied leading character from the given String.
     * @param $str string the String to check
     * @param $leadingCharacter string leadingCharacter the leading character to be trimmed
     * @return string the trimmed String
     */
    public static function trimLeadingCharacter($str, $leadingCharacter) {
        if (!self::hasLength($str)) {
            return $str;
        }
        $strLength = strlen($str);
        $firstIndex = 0;
        for($i=0; $i<$strLength; $i++){
            if($str[$i]==$leadingCharacter){
                $firstIndex++;
            }else{
                break;
            }
        }
        return substr($str, $firstIndex);
    }
    
    
    /**
     * Trim all occurrences of the supplied trailing character from the given String.
     * @param $str string the String to check
     * @param $leadingCharacter string the trailing character to be trimmed
     * @return string the trimmed String
     */
    public static function trimTrailingCharacter($str, $leadingCharacter) {
        if (!self::hasLength($str)) {
            return $str;
        }
        $strLength = strlen($str);
        $lastIndex = $strLength;
        
        for($i=$strLength-1; $i>=0; $i--){
            if($str[$i]==$leadingCharacter){
                $lastIndex--;
            }else{
                break;
            }
        }
        return substr($str, 0, $lastIndex);
    }
    
    
}