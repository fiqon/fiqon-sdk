<?php
namespace Fiqon;

class Immediate extends Event {
    public function __construct(int $timeout = 240) {
        $this->timeout = $timeout;
    }

    public function getPath() : string {
        return "event/immediate";
    }
}