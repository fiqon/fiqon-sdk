<?php
namespace Fiqon;

abstract class Request {
    /**
     * @var array  $headers
     * @var string $transmission_identifier, $url
     */
    protected array $headers;
    protected string $url = "https://fique.online/", $transmission_identifier;

    /**
     * @param string $transmission
     * @param string $service = ""
     * @param string $token = ""
     * @param string $event = ""
     * @param array  $request_type
     */
    function __construct(?string $transmission = null) {
        $this->transmission_identifier = $transmission ?? Transmission::getIdentifier();

        $this->reset();
    }

    public function getTransmission() : string {
        return $this->transmission_identifier;
    }

    /**
     *  @param array $headers
     */
    public function addHeaders(array $headers) : void {
        if ($headers === null) {
            return;
        }

        foreach ($headers as $key => $value) {
            $this->headers[$key] = $value;
        }
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function addHeader(string $key, string $value) : void {
        $this->headers[$key] = $value;
    }

    /**
     *  @param string $key
     */
    public function removeHeader(string $key) : void {
        unset($this->headers[$key]);
    }

    /**
     * @return array
     */
    public function getHeaders() : array {
        return $this->headers;
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

        echo "{$url}{$this->getPath()}\n";
        echo "{$this->getBody()}\n";
        var_dump($this->buildHeaders());

        curl_setopt_array($curl, [
            CURLOPT_URL => "{$url}{$this->getPath()}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 240,
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

    protected function resetHeader() : void {
        $this->headers = [];
        $headers = [
            'content-type'=> 'application/json',
            'accept' => 'application/json',
        ];

        $this->addHeaders($headers);
    }

    public abstract function getBody() : string;
    public abstract function reset() : void;
    public abstract function getPath() : string;
}