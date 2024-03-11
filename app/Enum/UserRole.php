<?php

namespace App\Enum;

enum UserRole: int
{
    case Contributor = 0;

    case Administrator = 1;

    case ContentManager = 2;

    public static function getName(UserRole $role): string
    {
        switch ($role){
            case UserRole::Administrator:
                return 'Administrator';
            case UserRole::Contributor:
                return 'Contributor';
            case UserRole::ContentManager:
                return 'Content Manager';
        }
        return '';
    }
}
