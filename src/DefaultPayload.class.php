<?php
namespace Fiqon;

class DefaultPayload {
    private string $service_identifier, $service_token, $event;
    private ?array $object;

    /**
     * @param string $service
     * @param string $token
     * @param string $event
     * @param array  $object
     */
    function __construct(?string $service = null, ?string $token = null, ?string $event = null, ?array $object = null) {
        $this->service_identifier = $service ?? Transmission::getService();
        $this->service_token = $token ?? Transmission::getToken();
        $this->event = $event ?? Transmission::getEvent();
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
        $this->event = $event;
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
    function getEvent() : string {
        return $this->event;
    }

    /**
     * @return array
     */
    public function getObject() : array {
        return $this->object;
    }

    /**
     * @return string
     */
    function encode() : string {
        return json_encode(
            value: [
                    "event" => $this->event,
                    "token" => $this->service_token,
                    "sent_from" => $this->service_identifier,
                    "data" => $this->object,
                ],
            flags: JSON_THROW_ON_ERROR,
            depth: 250
        );
    }
}