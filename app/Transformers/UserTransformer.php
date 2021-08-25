<?php

namespace App\Transformers;

use App\Models\Profile;
use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
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
        'profile'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id' => $user->_id,
            'email' => $user->email
        ];
    }

    public function includeProfile(User $user)
    {
        $profile = $user->profile;

        if ($user->profile)
            return $this->item($profile, new ProfileTransformer());

        return null;
    }
}
