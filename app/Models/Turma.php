<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Turma
 * @package App\Models
 * @version October 26, 2021, 10:57 am -03
 *
 * @property string $nome
 * @property string $curso
 */
class Turma extends Model
{
    use SoftDeletes;

    public $table = 'turmas';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'nome',
        'curso',
        'periodo',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nome' => 'string',
        'curso' => 'string',
        'periodo' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function user()
    {
        return $this->hasMany('App\Users');
    }

    
}
