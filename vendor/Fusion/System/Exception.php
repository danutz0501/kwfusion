<?php
function myException($exception)
{
    echo '<div class="console"><i class="fa fa-exclamation-triangle"></i> <b>Exception:</b> ' . $exception->getMessage() . '</div>';
}

set_exception_handler('myException');


class KW_Exception extends Exception
{
    public function errorMessage() {
    //error message
    $errorMsg = '<div class="alert alert-danger"><i class="fa fa-frown-o"></i> 
                Error on line '.$this->getLine().' in '.$this->getFile().
                ': <b>'.$this->getMessage().'</b> is not a valid E-Mail address</div>';
    return $errorMsg;
    }
}