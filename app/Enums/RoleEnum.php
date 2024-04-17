<?php

namespace App\Enums;

enum RoleEnum : string
{
    case ADMIN = "Admin";
    case LIBRARIAN = "Librarian";
    case CLIENT = "Client";
}