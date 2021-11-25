<?php
namespace Fiqon;

use Throwable;

abstract class ErrFiqon extends \Throwable {
    public abstract function getMessage() : string;
    public abstract function getCode() : int;
    public abstract function getFile() : string;
    public abstract function getLine() : int;
    public abstract function getTrace() : array;
    public abstract function getTraceAsString() : string;
    public abstract function getPrevious() : ?Throwable;
    public abstract function __toString() : string;
}