<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;

class RoleExtension extends AbstractExtension implements GlobalsInterface {
    public function getGlobals(): array
    {
        return [
            "Roles" => Roles::class
        ];
    }
}

?>