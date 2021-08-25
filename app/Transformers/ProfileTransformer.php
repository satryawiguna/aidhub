<?php

namespace App\Transformers;

use App\Models\Profile;
use League\Fractal\TransformerAbstract;

class ProfileTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Profile $profile)
    {
        return [
            'first_name' => $profile->first_name,
            'last_name' => $profile->last_name,
            'dob' => $profile->dob,
            'avatar' => $profile->avatar,
            'address' => $profile->address,
        ];
    }
}
