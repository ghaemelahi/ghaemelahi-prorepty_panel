<?php
declare(strict_types=1);

namespace App\Enumes;

enum UserSystemRole :string{
    case Admin = 'admin';
    case Secretary = 'secretary';
}