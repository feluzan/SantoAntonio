<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Ticket
 * @package App\Models
 * @version April 13, 2020, 4:13 pm UTC
 *
 */
class Ticket extends Model
{
    use SoftDeletes;

    public $table = 'tickets';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'refeicao_id',
        'assistido_id',
        'emissor_id',
        'valor',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * The refeicao associated with ticket
     */
    public function refeicao()
    {
        return $this->belongsTo('App\Model\Refeicao');
    }

    /**
     * The user assistido associated with ticket
     */
    public function assistido()
    {
        return $this->belongsTo('App\Model\UserRole');
    }

    /**
     * The user emissor associated with ticket
     */
    public function emissor()
    {
        return $this->belongsTo('App\Model\UserRole');
    }
}
