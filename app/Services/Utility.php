<?php

namespace App\Services;

class Utility
{
    public static function makeId($q)
    {
        $table = [];
        foreach ($q as $item) {
            $table[] = $item->id;
        }
        $id = 1;

        foreach ($table as $value) {
            if ($value != $id) {
                break;
            }
            $id++;
        }
        return $id;
    }
}
