<?php

namespace App\Exceptions;

use Exception;

class NoSelectedDataStoreException extends Exception {

    public function render($request) {
        return abort(403, 'No data store');
    }

}
