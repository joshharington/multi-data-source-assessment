<?php


namespace App\Utilities;


use App\User;
use App\Utilities\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DataStoreDBWrapper {

    static public function getAll() {
        try {
            $data = User::orderBy('id', 'ASC')->get()->toArray();

            // Return array converted to UserModel
            return array_map(function($object) {
                return new UserModel($object['id'], $object['name'], $object['email'], $object['date_of_birth']);
            }, $data);
        } catch(\Exception $e) {
            Log::error('Error getting all data from DataStoreDBWrapper@getAll');
            Log::error('Code: ' . $e->getCode());
            Log::error('Message: ' . $e->getMessage());

            // Return an empty array
            return [];
        }
    }

    static public function find($value, $key, int $limit = null) {
        try {

            $check_key = "";

            // Check based on provided key
            switch($key) {
                case "ID":
                    $check_key = 'id';
                    break;
                case "NAME":
                    $check_key = 'name';
                    break;
                case "EMAIL":
                    $check_key = 'email';
                    break;
                case "DATE OF BIRTH":
                    $check_key = 'date_of_birth';
                    break;
            }

            $results = User::where($check_key, $value)->get()->toArray();

            $results = array_map(function($object) {
                return new UserModel($object['id'], $object['name'], $object['email'], $object['date_of_birth']);
            }, $results);

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
            Log::error('Error getting all data from DataStoreDBWrapper@find');
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
                $user = User::find($id);
                if($user) {
                    return self::updateUser($user, $name, $email, $date_of_birth);
                }
            } else {
                $user = User::where('email', $email)->first();
                if($user) {
                    // Update
                    return self::updateUser($user, $name, $email, $date_of_birth);
                }

                // Create new
                return self::createUser($name, $email, $date_of_birth);
            }
        } catch(\Exception $e) {
            Log::error('Error getting all data from DataStoreDBWrapper@createOrUpdate');
            Log::error('Code: ' . $e->getCode());
            Log::error('Message: ' . $e->getMessage());

            return false;
        }
    }

    static public function createUser($name, $email, $date_of_birth) {
        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->date_of_birth = $date_of_birth;
        $user->password = Hash::make('12345678a!');
        $user->save();

        return $user->toUserModel();
    }

    static public function updateUser(User $user, $name, $email, $date_of_birth) {
        $user->name = $name;
        $user->email = $email;
        $user->date_of_birth = $date_of_birth;
        $user->save();

        return $user->toUserModel();
    }

    static public function storeAll($data) {
        $password = Hash::make('12345678a!');
        $time = Carbon::now();

        $array_data = json_decode(json_encode($data), true);

        for($i = 0; $i < count($array_data); $i++) {
            $array_data[$i]['password'] = $password;
            $array_data[$i]['created_at'] = $time;
            $array_data[$i]['updated_at'] = $time;
        }

        User::truncate();
        User::insert($array_data);

        return true;
    }

    static public function CreateDemoUser() {
        // Insert Demo User
        $user = new User;
        $user->name = "Josh";
        $user->email = "josh1@live.co.za";
        $user->password = Hash::make('12345678a!');
        $user->save();
    }

}
