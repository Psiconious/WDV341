<?php
function v_array($needle, $haystack) {
    if(is_array($haystack) && array_key_exists($needle, $haystack)) {
        return $haystack[$needle];
    }

    return 0;
}

/**
 * Check if the name is set
 * The name cannot be empty
 * @param string | $name | Name of the monkey
 * @return bool | true/false
 */
function valid_name($name) {
    if($name == ""){
        return false;
    }
    else{
        return true;
    }
}

/**
 * Make sure that a size is selected
 * The size cannot be empty
 * @param string | $size | Selected monkey size
 * @return bool | true/false
 */
function valid_size($size) {
    if($size == ""){
        return false;
    }
    else{
        return true;
    }
}

/**
 * Make sure that a color is selected and not solid white or black
 * The color cannot be solid black or white
 * @param string | $color | Hexidecimal color
 * @return bool | true/false
 */
function valid_color($color) {}
?>