<?php
namespace Fiqon;

class Immediate extends Event {
    public function getPath() : string {
        return "event/immediate";
    }
}