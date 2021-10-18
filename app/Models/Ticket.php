<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\DateFormatService;


/**
 * Class Ticket
 * @package App\Models
 * @version April 13, 2020, 4:13 pm UTC
 *
 */
class Ticket extends Model
{
    use SoftDeletes;
    use DateFormatService;

    public $table = 'tickets';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'refeicao_id',
        'assistido_id',
        'emissor_id',
        'valor',
        'data_refeicao',
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
        return $this->belongsTo('App\Models\Refeicao');
    }

    /**
     * The user assistido associated with ticket
     */
    public function assistido()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The user emissor associated with ticket
     */
    public function emissor()
    {
        return $this->belongsTo('App\User');
    }


    public function getFormattedCreatedAtAttribute()
    {
        return $this->formatDate($this->created_at);
    }

    public function getFormattedDataRefeicaoAttribute()
    {
        return $this->formatDate($this->data_refeicao);
    }

    public function getFormattedValueAttribute(){
        return $this->formatCurrencyValue($this->valor);
    }
}
