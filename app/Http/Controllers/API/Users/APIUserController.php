<?php

namespace App\Http\Controllers\API\Users;

use App\Transformers\GeneralErrorTransformer;
use App\Transformers\UserModelTransformer;
use App\Utilities\DataStoreHelper;
use App\Utilities\Models\GeneralErrorModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class APIUserController extends Controller {

    public function index() {
        $users = DataStoreHelper::getAll();

        return fractal()->collection($users)->transformWith(new UserModelTransformer)->toJson();
    }

    public function store(Request $request) {
        $name = $request->get('name');
        $email = $request->get('email');
        $date_of_birth = $request->get('date_of_birth');
        $user_id = $request->get('user_id');

        // Validation - Check if there is an existing user with the provided email and different user_id
        $user = DataStoreHelper::find($email, "EMAIL", 1);
        if($user) {
            // User exists
            if($user->id != $user_id) {
                // Email already exists to another user
                return fractal()->item(new GeneralErrorModel(422, "That email is already in use."))->transformWith(new GeneralErrorTransformer())->respond(422);
            }
        }

        // Create user
        $user = DataStoreHelper::createOrUpdate($name, $email, $date_of_birth, $user_id);
        if(!$user) {
            // Failed to create or update, return error
            return fractal()->item(new GeneralErrorModel(422, "Something went wrong. Please try again later."))->transformWith(new GeneralErrorTransformer())->respond(422);
        }
        return fractal()->item($user)->transformWith(new UserModelTransformer)->toJson();
    }

    public function show($id) {
        $user = DataStoreHelper::find($id, "ID", 1);
        if(!$user) {
            return fractal()->item(new GeneralErrorModel(404, "User not found."))->transformWith(new GeneralErrorTransformer())->respond(404);
        }

        return fractal()->item($user)->transformWith(new UserModelTransformer)->toJson();
    }

    public function update(Request $request, $id) {
        $name = $request->get('name');
        $email = $request->get('email');
        $date_of_birth = $request->get('date_of_birth');

        // Validation - Check if there is an existing user with the provided email and different user_id
        $user = DataStoreHelper::find($email, "EMAIL", 1);
        if($user) {
            // User exists
            if($user->id != $id) {
                // Email already exists to another user
                return fractal()->item(new GeneralErrorModel(422, "That email is already in use."))->transformWith(new GeneralErrorTransformer())->respond(422);
            }
        }

        // Update user
        $user = DataStoreHelper::createOrUpdate($name, $email, $date_of_birth, $id);
        if(!$user) {
            // Failed to create or update, return error
            return fractal()->item(new GeneralErrorModel(422, "Something went wrong. Please try again later."))->transformWith(new GeneralErrorTransformer())->respond(422);
        }
        return fractal()->item($user)->transformWith(new UserModelTransformer)->toJson();
    }

}
