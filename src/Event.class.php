<?php
namespace Fiqon;

class Event extends Request {
    private DefaultPayload $payload;

    public function __construct(?string $transmission = null, ?string $service = null, ?string $token = null, ?string $event = null) {
        parent::__construct($transmission);

        $this->payload =  new DefaultPayload($service, $token, $event);
    }

    public function setService(string $service_identifier, string $service_token) {
        $this->setServiceIdentifier($service_identifier);
        $this->setServiceToken($service_token);
    }

    public function setServiceIdentifier(string $service) {
        $this->payload->setServiceIdentifier($service);
    }

    public function setServiceToken(string $token) {
        $this->payload->setServiceToken($token);
    }

    public function setEvent(string $event) {
        $this->payload->setEvent($event);
    }

    public function setObject(array $object) {
        $this->payload->setObject($object);
    }

    public function getBody() : string {
        return $this->payload->encode();
    }

    public function reset() : void {
        $this->payload = new DefaultPayload();

        $this->transmission_identifier = Transmission::getIdentifier();
    }

    public function getPath() : string {
        return 'event';
    }
}