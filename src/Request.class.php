<?php
namespace Fiqon;

abstract class Request {
    /**
     * @var array  $headers
     * @var string $transmission_identifier, $url
     */
    protected array $headers;
    protected string $url = "https://fique.online/", $transmission_identifier;
    protected int $timeout = 240;

    /**
     * @param string $transmission
     * @param string $service = ""
     * @param string $token = ""
     * @param string $event = ""
     * @param array  $request_type
     */
    function __construct(?string $transmission = null, int $timeout = 240) {
        $this->transmission_identifier = $transmission ?? Transmission::getIdentifier();

        $this->timeout = $timeout;
        $this->headers = [
            'content-type'=> 'application/json',
            'accept' => 'application/json',
        ];
    }

    /**
     * @param string $identifier
     */
    public function setTransmissionIdentifier(string $identifier) : void {
        $this->transmission_identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getTransmission() : string {
        return $this->transmission_identifier;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isHeaderSet($key) : bool {
        return isset($this->headers[$key]);
    }

    /**
     * @return array
     */
    public function sendRequest() : array {
        $curl = curl_init();

        $url = Transmission::getUrl() ?? $this->url;

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$url}/{$this->getPath()}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_POST => 1,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $this->getBody(),
            CURLOPT_HTTPHEADER => $this->buildHeaders(),
        ]);

        $response['data'] = curl_exec($curl);
        $response['code'] = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
        curl_close($curl);

        return $response;
    }

    /**
     * @return array
     */
    protected function buildHeaders() : array {
        $headers = array();

        $this->headers["x-transmission"] = "Group {$this->transmission_identifier}";

        foreach ($this->headers as $key => $value) {
            array_push($headers, "{$key}: {$value}");
        }

        return $headers;
    }

    public abstract function getBody() : string;
    public abstract function reset() : void;
    public abstract function getPath() : string;
}