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
 * @property integer refeicao_id
 */
class Auxilio extends Model
{
    use SoftDeletes;

    public $table = 'auxilios';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'refeicao_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'refeicao_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * The user associated with auxilio
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * The refeicao associated with auxilio
     */
    public function refeicao()
    {
        return $this->belongsTo('App\Models\Refeicao', 'refeicao_id');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->formatDate($this->created_at);
    }
    
}
