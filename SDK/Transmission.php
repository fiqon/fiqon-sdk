<?php
namespace Fiqon;

class Transmission {
    private static string $transmission_identifier = "", $service = "", $token = "", $event = "", $url_base = "";

    public static function setIdentifier(string $transmission_identifier) {
        self::$transmission_identifier = $transmission_identifier;
    }

    public static function setService(string $service) {
        self::$service = $service;
    }

    public static function setToken(string $token) {
        self::$token = $token;
    }

    public static function setEvent(string $event) {
        self::$event = $event;
    }

    public static function setUrl(string $url) {
        $url = trim($url, "/");
        self::$url_base = "{$url}/";
    }

    public static function getIdentifier() : string {
        return self::$transmission_identifier;
    }

    public static function getService() : string {
        return self::$service;
    }

    public static function getToken() : string {
        return self::$token;
    }

    public static function getEvent() : string {
        return self::$event;
    }

    public static function getUrl() : ?string {
        return self::$url_base != ""? self::$url_base : null;
    }
}