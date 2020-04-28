<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Refeicao
 * @package App\Models
 * @version April 13, 2020, 1:37 pm UTC
 *
 * @property string nome
 * @property time inicio
 * @property time fim
 * @property number valor
 * @property bool habilitada
 */
class Refeicao extends Model
{
    use SoftDeletes;

    public $table = 'refeicaos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nome',
        'inicio',
        'fim',
        'valor',
        'habilitada',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'valor' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * Get the auxilio for the refeicao.
     */
    public function auxilio()
    {
        return $this->hasMany('App\Models\Auxilio');
    }

}
