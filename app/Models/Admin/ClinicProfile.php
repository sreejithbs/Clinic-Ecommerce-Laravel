<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Clinic;

class ClinicProfile extends Model
{
    use SoftDeletes;  // enable Soft Delete

    protected $table = 'clinic_profiles';

    /**
     * Relation
     */
    public function clinic(){
        return $this->belongsTo(Clinic::class);
    }

}