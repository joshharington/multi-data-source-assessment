<?php


namespace App\Utilities;


use App\Utilities\Models\UserModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class DataStoreJsonWrapper {

    static public function getAll() {
        try {
            // Read from file, store in list of UserModel
            $file_name = env('DATASTORE_JSON_FILENAME');
            if (!File::exists(storage_path('app/' . $file_name))) {
                // File does NOT exist
                // Return an empty array
                return [];
            }

            // Get file contents
            $contents = file_get_contents(storage_path('app/' . $file_name));

            // Decode from JSON
            $data = json_decode($contents, true);

            // Return array converted to UserModel
            return array_map(function($object) {
                return new UserModel($object["id"], $object["name"], $object["email"], $object["date_of_birth"]);
            }, $data);
        } catch(\Exception $e) {
            Log::error('Error getting all data from DataStoreJsonWrapper@getAll');
            Log::error('Code: ' . $e->getCode());
            Log::error('Message: ' . $e->getMessage());

            // Return an empty array
            return [];
        }
    }

    static public function find($value, $key, int $limit = null) {
        try {
            $data = self::getAll();

            $results = [];
            foreach($data as $user) {
                $check_string = "";

                // Check based on provided key
                switch($key) {
                    case "ID":
                        $check_string = $user->id;
                        break;
                    case "NAME":
                        $check_string = $user->name;
                        break;
                    case "EMAIL":
                        $check_string = $user->email;
                        break;
                    case "DATE OF BIRTH":
                        $check_string = $user->date_of_birth;
                        break;
                }

                // Check if string is equal to the value
                if($check_string == $value) {
                    // Matches, add to results
                    $results[] = $user;
                }
            }

            if(count($results) == 0) {
                // No results
                return null;
            }

            if($limit != null) {
                if($limit == 1) {
                    return $results[0];
                }

                if($limit > count($results)) {
                    // Limit is more than results, set limit to result length so we dont get an index out of bounds error
                    $limit = count($results);
                }

                // Return limited results
                return array_slice($results, 0, $limit, true);
            }

            return $results;
        } catch(\Exception $e) {
            Log::error('Error getting all data from DataStoreJsonWrapper@find');
            Log::error('Code: ' . $e->getCode());
            Log::error('Message: ' . $e->getMessage());

            // Return an empty array
            return null;
        }
    }

    static public function createOrUpdate($name, $email, $date_of_birth, $id = null) {
        try {
            // See if user exists
            if($id != null) {
                // Update
                $user = self::find($id, "ID", 1);
                return self::updateUser($user, $name, $email, $date_of_birth);
            } else {
                $user = self::find($email, "EMAIL", 1);
                if($user) {
                    // Update
                    return self::updateUser($user, $name, $email, $date_of_birth);
                }

                // Create new
                return self::createUser($name, $email, $date_of_birth);
            }
        } catch(\Exception $e) {
            Log::error('Error getting all data from DataStoreJsonWrapper@createOrUpdate');
            Log::error('Code: ' . $e->getCode());
            Log::error('Message: ' . $e->getMessage());

            return false;
        }
    }

    static public function createUser($name, $email, $date_of_birth) {
        $data = self::getAll();
        // Sort data DESC by ID
        usort($data, function(UserModel $a, UserModel $b) { return ($a->id < $b->id); });
        $last_id = $data[0]->id;
        $new_id = $last_id + 1;
        $user = new UserModel($new_id, $name, $email, $date_of_birth);

        // Sort data ASC by ID
        usort($data, function(UserModel $a, UserModel $b) { return ($a->id > $b->id); });

        // Add new user
        $data[] = $user;

        // Convert to JSON and store
        $jsonData = json_encode($data);
        $filename = storage_path('app/'. env('DATASTORE_JSON_FILENAME'));

        // return result
        $res = file_put_contents($filename, $jsonData);
        if($res) {
            // Success, return user
            return $user;
        }

        // Error, return false
        return false;
    }

    static public function updateUser(UserModel $user, $name, $email, $date_of_birth) {
        $data = self::getAll();

        $user->name = $name;
        $user->email = $email;
        $user->date_of_birth = $date_of_birth;

        // Sort data ASC by ID
        usort($data, function(UserModel $a, UserModel $b) { return ($a->id > $b->id); });

        // Update User
        for($i = 0; $i < count($data); $i++) {
            if($data[$i]->id == $user->id) {
                $data[$i] = $user;
                break;
            }
        }

        // Convert to JSON and store
        $jsonData = json_encode($data);
        $filename = storage_path('app/'. env('DATASTORE_JSON_FILENAME'));

        // return result
        $res = file_put_contents($filename, $jsonData);
        if($res) {
            // Success, return user
            return $user;
        }

        // Error, return false
        return false;
    }

    static public function storeAll($data) {
        $jsonData = json_encode($data);
        $filename = storage_path('app/'. env('DATASTORE_JSON_FILENAME'));

        // return result
        $res = file_put_contents($filename, $jsonData);
        if($res) {
            // Success, return user
            return true;
        }

        return false;
    }

}
