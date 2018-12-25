<?php

namespace App\Policies;

use App\Entity\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Entity\SalesRecord;

class SalesRecordPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function destroy(User $user, SalesRecord $salesRecord)
    {
        return $user->id === $salesRecord->user_id;
    }
}
