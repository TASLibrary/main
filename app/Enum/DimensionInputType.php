<?php

namespace App\Enum;

enum DimensionInputType: int
{
    case SingleChoince = 0;
    case MultipleChoice = 1;

    public static function getName(DimensionInputType $input_type): string
    {
        switch ($input_type){
            case DimensionInputType::MultipleChoice:
                return 'Multiple Choice';
            case DimensionInputType::SingleChoince:
                return 'Single Choice';
        }
        return '';
    }
}
