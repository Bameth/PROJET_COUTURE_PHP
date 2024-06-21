<?php
namespace ab\Core;

class Autorisation {
    public static function isConnect(): bool {
        return Session::get("userConnect") !== false;
    }

    public static function hasRole(string $roleName): bool {
        $userConnect = Session::get("userConnect");
        return $userConnect && $userConnect["name"] === $roleName;
    }
}
