<?php


namespace App\Transformers;


use App\Utilities\Models\UserModel;
use League\Fractal\TransformerAbstract;

class UserModelTransformer extends TransformerAbstract {

    function transform(UserModel $item) {
        return $item->toJson();
    }

}
