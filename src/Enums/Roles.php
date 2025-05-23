<?php 

namespace App\Enums;

enum Roles: string {
    case ADMIN = "ROLE_ADMIN";
    case DIRECTEUR = "ROLE_DIRECTEUR";
    case CHEF = "ROLE_CHEF";
    case RESPONSABLE = "ROLE_RESPONSABLE";
}

?>