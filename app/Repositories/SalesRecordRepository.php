<?php

namespace App\Repositories;

use App\Entity\User;
use App\Entity\SalesRecord;

class SalesRecordRepository
{
    /**
     * 取得給定使用者的所有任務。
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user)
    {
        return SalesRecord::where('user_id', $user->id)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}
