<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Services\DateFormatService;

/**
 * Class Documento
 * @package App\Models
 * @version March 30, 2021, 2:43 pm -03
 *
 */
class Documento extends Model
{
    use SoftDeletes;
    use DateFormatService;

    public $table = 'documentos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'path',
        'nome',
        'descricao',
        'data_autenticacao',
        'autenticador_id',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'data_autenticacao' => 'datetime',
        'autenticador_id' => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * The user associated with documento
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * The user responsible to authenticate documento
     */
    public function autenticador()
    {
        return $this->belongsTo('App\User', 'autenticador_id');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->formatDate($this->created_at);
    }

    public function getFormattedDataAutenticacaoAttribute()
    {
        return $this->formatDate($this->created_at);
    }

    
}
