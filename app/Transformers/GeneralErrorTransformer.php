<?php


namespace App\Transformers;


use App\Utilities\Models\GeneralErrorModel;
use League\Fractal\TransformerAbstract;

class GeneralErrorTransformer extends TransformerAbstract {

    function transform(GeneralErrorModel $data) {
        return $data->toJson();
    }

}
