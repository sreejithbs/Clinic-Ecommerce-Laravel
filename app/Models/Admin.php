<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

class Admin extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // to assign Uuid value as default
    
    protected $guard = 'admin';

    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Check if super admin
     *
     * @return boolean
     */
    public function isSuper($admin)
    {
        return $admin->isSuper;
    }
}
