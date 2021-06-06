<?php

namespace App\Exceptions;

use Exception;

class InvalidDataStoreException extends Exception {

    public function render($request) {
        return abort(403, 'Invalid data store type');
    }

}
