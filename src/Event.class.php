<?php
namespace Fiqon;

class Event extends Request {
    private DefaultPayload $payload;

    /**
     * @param string $transmission
     * @param string $service
     * @param string $token
     * @param string $event
     */
    public function __construct(?string $transmission = null, ?string $service = null, ?string $token = null, ?string $event = null, ?array $object = null) {
        parent::__construct($transmission);

        $this->payload =  new DefaultPayload($service, $token, $event, $object);
    }

    /**
     * @param string $service_identifier
     * @param string $service_token
     */
    public function setService(string $service_identifier, string $service_token) : void {
        $this->setServiceIdentifier($service_identifier);
        $this->setServiceToken($service_token);
    }

    /**
     * @param string $identifier
     */
    public function setServiceIdentifier(string $identifier) : void {
        $this->payload->setServiceIdentifier($identifier);
    }

    /**
     * @param string $token
     */
    public function setServiceToken(string $token) : void {
        $this->payload->setServiceToken($token);
    }

    /**
     * @param string $event
     */
    public function setEvent(string $event) : void {
        $this->payload->setEvent($event);
    }

    /**
     * @param array $object
     */
    public function setObject(array $object) : void {
        $this->payload->setObject($object);
    }

    /**
     * @return string
     */
    public function getServiceIdentifier() : string {
        return $this->payload->getServiceIdentifier();
    }

    /**
     * @return string
     */
    public function getServiceToken() : string {
        return $this->payload->getServiceToken();
    }

    /**
     * @return string
     */
    public function getEvent() : string {
        return $this->payload->getEvent();
    }

    /**
     * @return array
     */
    public function getObject() : array {
        return $this->payload->getObject();
    }

    /**
     * @return string
     */
    public function getBody() : string {
        return $this->payload->encode();
    }

    /**
     * @return void
     */
    public function reset() : void {
        $this->payload = new DefaultPayload();

        $this->transmission_identifier = Transmission::getIdentifier();
    }

    /**
     * @return string
     */
    public function getPath() : string {
        return 'event';
    }
}