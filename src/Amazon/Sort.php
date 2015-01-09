<?php
namespace Amazon;
class Sort {
    public static function asc($key) {
        return function($a ,$b) use ($key) {
            return strcmp( $a->{$key}, $b->{$key});
        };
    }
}
