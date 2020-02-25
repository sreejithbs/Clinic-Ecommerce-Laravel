<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UuidTrait;

use App\Models\Admin\ClinicProfile;

class Clinic extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;  // enable Soft Delete
    use UuidTrait;  // to assign Uuid value as default

    protected $guard = 'clinic';

    protected $table = 'clinic_admins';

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
     * Relation
     */
    public function clinic_profile(){
        return $this->hasOne(ClinicProfile::class, 'clinicAdminId');
    }
}