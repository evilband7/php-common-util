<?php
namespace PhpCommonUtil\Util;

class StringUtils
{
    
    /**
     * Check whether the given String is empty.
     * <p>This method accepts any Object as an argument, comparing it to
     * {@code null} and the empty String. As a consequence, this method
     * will never return {@code true} for a non-null non-String object.
     * <p>The Object signature is useful for general attribute handling code
     * that commonly deals with Strings but generally has to iterate over
     * Objects since attributes may e.g. be primitive value objects as well.
     * @param str the candidate String
     */
    public static function isEmpty($str) {
        Assert::isStringOrNull($str);
        return empty($str);
    }
    
    
    /**
     * Check that the given CharSequence is neither {@code null} nor of length 0.
     * Note: Will return {@code true} for a CharSequence that purely consists of whitespace.
     * <p><pre class="code">
     * StringUtils::hasLength(null) = false
     * StringUtils::hasLength("") = false
     * StringUtils::hasLength(" ") = true
     * StringUtils::hasLength("Hello") = true
     * </pre>
     * @param $str the string to check (may be {@code null})
     * @return {@code true} if the CharSequence is not null and has length
     */
    public static function  hasLength($str) {
        Assert::isStringOrNull($str);
        return !(is_null($str) || strlen($str)==0);
    }
    
    
    /**
     * Check whether the given CharSequence has actual text.
     * More specifically, returns {@code true} if the string not {@code null},
     * its length is greater than 0, and it contains at least one non-whitespace character.
     * <p><pre class="code">
     * StringUtils.hasText(null) = false
     * StringUtils.hasText("") = false
     * StringUtils.hasText(" ") = false
     * StringUtils.hasText("12345") = true
     * StringUtils.hasText(" 12345 ") = true
     * </pre>
     * @param string $str the CharSequence to check (may be {@code null})
     * @return {@code true} if the CharSequence is not {@code null},
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
     * Check whether the given CharSequence contains any whitespace characters.
     * @param str the CharSequence to check (may be {@code null})
     * @return {@code true} if the CharSequence is not empty and
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
    * @param str the String to check
    * @return the trimmed String
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
     * @param str the String to check
     * @return the trimmed String
     */
    public static function trimAllWhitespace($str) {
        if (!self::hasLength($str)) {
            return str;
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
     * @param str the String to check
     * @return the trimmed String
     */
    public static function  trimLeadingWhitespace($str) {
        if (!self::hasLength($str)) {
            return $str;
        }
        return ltrim($str);
    }
    
    
    /**
     * Trim trailing whitespace from the given String.
     * @param str the String to check
     * @return the trimmed String
     * @see java.lang.Character#isWhitespace
     */
    public static function  trimTrailingWhitespace($str) {
        if (!self::hasLength($str)) {
            return $str;
        }
        return rtrim($str);
    }
    
    /**
     * Trim all occurrences of the supplied leading character from the given String.
     * @param str the String to check
     * @param leadingCharacter the leading character to be trimmed
     * @return the trimmed String
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
     * @param str the String to check
     * @param trailingCharacter the trailing character to be trimmed
     * @return the trimmed String
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