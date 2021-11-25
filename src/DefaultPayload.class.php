<?php
namespace Fiqon;

class DefaultPayload {
    /**
     * @var string $service_identifier, $service_token, $event_identifier
     * @var array $object
     */
    private string $service_identifier, $service_token, $event_identifier;
    private ?array $object;

    /**
     * @param string $service
     * @param string $token
     * @param string $event
     * @param array  $object
     */
    function __construct(?string $service = "", ?string $token = "", ?string $event = "", ?array $object = null) {
        $this->service_identifier = $service ?? Transmission::getService();
        $this->service_token = $token ?? Transmission::getToken();
        $this->event_identifier = $event ?? Transmission::getEvent();
        $this->object = $object;
    }

    /**
     * @param string $service
     */
    function setServiceIdentifier(string $service) : void {
        $this->service_identifier = $service;
    }

    /**
     * @param string $token
     */
    function setServiceToken(string $token) : void {
        $this->service_token = $token;
    }

    /**
     * @param string $event
     */
    function setEvent(string $event) : void {
        $this->event_identifier = $event;
    }

    public function setObject(array $object) : void {
        $this->object = $object;
    }

    /**
     * @return string
     */
    function getServiceIdentifier() : string {
        return $this->service_identifier;
    }
    
    /**
     * @return string
     */
    function getServiceToken() : string {
        return $this->service_token;
    }

    /**
     * @return string
     */
    function getEventIdentifier() : string {
        return $this->event_identifier;
    }

    /**
     * @return array
     */
    public function getObject() : array {
        return $this->object;
    }

    function encode() : string {
        return json_encode(
            value: [
                    "event" => $this->event_identifier,
                    "token" => $this->service_token,
                    "sent_from" => $this->service_identifier,
                    "data" => $this->object,
                ],
            flags: JSON_THROW_ON_ERROR,
            depth: 250
        );
    }
}