<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Services\DateFormatService;

class User extends Authenticatable
{
    use Notifiable;
    use DateFormatService;

    public $levels = array(
        0 => 'Sem Funções',
        1 => 'Administrador',
        2 => 'Gestor do Auxílio',
        3 => 'Restaurante',
        4 => 'Consultas de Relatórios',
    );

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];



    public function getFormattedCreatedAtAttribute()
    {
        return $this->formatDate($this->created_at);
    }

    public function getAccessLevelsArray(){
        return $this->levels;
    }

    public function getLevelDescription(){
        return $this->levels[$this->level];
    }

    public function getLevel(){
        return $this->level;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getName(){
        return $this->name;
    }
}
