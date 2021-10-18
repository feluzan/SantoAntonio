<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PermissaoAcesso
 * @package App\Models
 * @version October 13, 2021, 3:30 pm -03
 *
 * @property integer $user_id
 * @property integer $codigo
 */
class PermissaoAcesso extends Model
{
    use SoftDeletes;

    public $table = 'permissao_acessos';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'codigo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'codigo' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];
    

    /**
     * The user associated with permissao acesso
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getCodigo(){
        return $this->codigo;
    }
    
}
