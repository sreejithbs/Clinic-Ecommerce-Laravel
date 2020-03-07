<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClinicProfile extends Model
{
    use SoftDeletes;  // enable Soft Delete

    protected $table = 'clinic_profiles';

}