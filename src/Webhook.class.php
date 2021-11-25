<?php
namespace Fiqon;

class Webhook extends Request {
    var $webhook_identifier, $webhook_token;
    private array $object;

    function __construct($transmission ,$webhook, $token) {
        parent::__construct($transmission);

        $this->webhook_identifier = $webhook;
        $this->webhook_token = $token;
    }

    public function getBody() : string {
        return json_encode(
            value: $this->object,
            flags: JSON_THROW_ON_ERROR,
            depth: 250
        );
    }

    public function reset() : void {}
    public function getPath() : string {
        $query = http_build_query([
            "token" => $this->webhook_token,
        ]);

        return "{$this->transmission_identifier}/{$this->webhook_identifier}?{$query}";
    }
}