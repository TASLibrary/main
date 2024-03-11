<?php

namespace App\Enum;

enum UseCaseOrigin: int
{
    case Copied = 0;
    case Summary = 1;
    case Invented = 2;

    public static function getMessage(UseCaseOrigin $origin): string
    {
        switch ($origin){
            case UseCaseOrigin::Copied:
                return 'Copied and pasted from original source';
            case UseCaseOrigin::Summary:
                return 'Summary of original source';
            case UseCaseOrigin::Invented:
                return 'Invented';
        }

        return '';
    }
}
