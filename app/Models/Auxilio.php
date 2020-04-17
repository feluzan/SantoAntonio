<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Auxilio
 * @package App\Models
 * @version April 14, 2020, 1:48 pm UTC
 *
 * @property integer user_id
 * @property integer rrefeicao_id
 */
class Auxilio extends Model
{
    use SoftDeletes;

    public $table = 'auxilios';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'rrefeicao_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'rrefeicao_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
