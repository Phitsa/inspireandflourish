<?php

if (!function_exists('firstNames')) {
    function firstNames($completeName) {     
        //i would like to delete the prepositions too but it too complex, lets have this in this way.
        $names = explode(' ', $completeName);
        $firstThreeNames = array_slice($names,0,3);
        return implode(' ', $firstThreeNames);
    }
}

?>