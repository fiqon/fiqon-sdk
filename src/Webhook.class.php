<?php
namespace Fiqon;

class Webhook extends Request {
    private ?string $identifier, $token;
    private ?array $object, $queries, $paths;
    private bool $token_on_path = false;

    /**
     * @param string $transmission
     * @param string $ideitifier
     * @param string $token
     * @param array  $object
     * @param bool $token_on_path
     * @param array $headers
     * @param array $queries
     * @param int $timeout
     */
    function __construct(?string $transmission = null, ?string $identifier = null, ?string $token = null, ?array $object = null, bool $token_on_path = false, ?array $queries = null, ?array $headers = null, ?array $paths = null, int $timeout = 240) {
        parent::__construct($transmission, $timeout);

        $this->identifier = $identifier ?? Transmission::getWebhookIdentifier();
        $this->token = $token ?? Transmission::getWebhookToken();
        $this->object = $object;
        $this->queries = $queries;
        $this->headers = $headers;
        $this->token_on_path = $token_on_path;
        $this->paths = $paths;
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
     * @param bool $token_on_path
     */
    public function setTokenOnPath(bool $token_on_path) {
        $this->token_on_path = $token_on_path;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers) {
        $this->headers = $headers;
    }

    /**
     * @param array $queries
     */
    public function setQueries(array $queries) {
        $this->queries = $queries;
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
     * @return bool
     */
    public function getTokenOnPath() : bool {
        return $this->token_on_path;
    }

    /**
     * @return array
     */
    public function getHeaders() : array {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getQueries() : array {
        return $this->queries;
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
        $this->token = "";
        $this->object = null;
        $this->queries = null;
        $this->headers = null;
    }

    /**
     * @return string
     */
    public function getPath() : string {
        if ($this->token_on_path) {
            $query = http_build_query($this->queries);
            $path = join('/', $this->paths);

            return "webhook/{$this->transmission_identifier}/{$this->identifier}/{$this->token}/{$path}?{$query}";
        }

        $this->queries['token'] =  $this->token;
        $query = http_build_query($this->queries);

        return "webhook/{$this->transmission_identifier}/{$this->identifier}?{$query}";
    }
}