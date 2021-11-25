<?php

use Fiqon\Request;

class Immediate extends Request {
    public function getBody() : string {return "";}
    public function reset() : void {}
    public function getPath() : string {return "";}
}