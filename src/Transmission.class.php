<?php
namespace Fiqon;

class Transmission {
    private static string $transmission_identifier = "", $service = "", $token = "", $event = "", $url_base = "", $webhook_identifier = "", $webhook_token = "";

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
        self::$url_base = trim($url, "/");
    }

    public static function setWebhookIdentifier(string $identifier) {
        self::$event = $identifier;
    }

    public static function setWebhookToken(string $token) {
        self::$url_base = $token;
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

    public static function getWebhookIdentifier() : string {
        return self::$webhook_identifier;
    }

    public static function getWebhookToken() : ?string {
        return self::$webhook_token;
    }
}