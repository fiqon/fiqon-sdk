<?php
namespace Fiqon;

class Webhook extends Request {
    private string $identifier, $token;
    private array $object;

    /**
     * @param string $transmission
     * @param string $ideitifier
     * @param string $token
     * @param array  $object
     */
    function __construct(?string $transmission = null, string $identifier = "", string $token = "", array $object = null) {
        parent::__construct($transmission);

        $this->identifier = $identifier;
        $this->token = $token;
        $this->object = $object;
    }

    /**
     * @param string $ideitifier
     */
    public function setIdeitifier(string $identifier) {
        $this->identifier = $identifier;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token) {
        $this->token = $token;
    }

    /**
     * @param array $object
     */
    public function setObject(array $object) {
        $this->object = $object;
    }

    /**
     * @return string
     */
    public function getIdeitifier() : string {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getToken() : string {
        return $this->token;
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
    public function getBody() : string {
        return json_encode(
            value: $this->object,
            flags: JSON_THROW_ON_ERROR,
            depth: 250
        );
    }

    public function reset() : void {
        $this->identifier = "";
    }

    /**
     * @return string
     */
    public function getPath() : string {
        $query = http_build_query([
            "token" => $this->token,
        ]);

        return "{$this->transmission_identifier}/{$this->webhook_identifier}?{$query}";
    }
}