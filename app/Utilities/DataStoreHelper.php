<?php


namespace App\Utilities;


use App\Exceptions\InvalidDataStoreException;

class DataStoreHelper {

    static function getAll() {
        $type = env('STORE_TYPE');

        switch(strtoupper($type)) {
            case "DB":
                return DataStoreDBWrapper::getAll();
            case "JSON":
                return DataStoreJsonWrapper::getAll();
            default:
                throw new InvalidDataStoreException();
        }
    }

    static function find($value, $key, int $limit = null) {
        $type = env('STORE_TYPE');

        switch(strtoupper($type)) {
            case "DB":
                return DataStoreDBWrapper::find($value, $key, $limit);
            case "JSON":
                return DataStoreJsonWrapper::find($value, $key, $limit);
            default:
                throw new InvalidDataStoreException();
        }
    }

    static function createOrUpdate($name, $email, $date_of_birth, $id = null) {
        $type = env('STORE_TYPE');

        switch(strtoupper($type)) {
            case "DB":
                return DataStoreDBWrapper::createOrUpdate($name, $email, $date_of_birth, $id);
            case "JSON":
                return DataStoreJsonWrapper::createOrUpdate($name, $email, $date_of_birth, $id);
            default:
                throw new InvalidDataStoreException();
        }
    }

    static function getAllFromSource($type) {
        switch(strtoupper($type)) {
            case "DB":
                return DataStoreDBWrapper::getAll();
            case "JSON":
                return DataStoreJsonWrapper::getAll();
            default:
                throw new InvalidDataStoreException();
        }
    }

    static function overwriteDataSourceFromTruth($data, $type_to) {
        switch(strtoupper($type_to)) {
            case "DB":
                return DataStoreDBWrapper::storeAll($data);
            case "JSON":
                return DataStoreJsonWrapper::storeAll($data);
            default:
                throw new InvalidDataStoreException();
        }
    }

}
