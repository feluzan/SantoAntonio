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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'level','arquivado'
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
        'arquivado' => 'boolean',
    ];

        /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * Get the auxilio for the user.
     */
    public function auxilio()
    {
        return $this->hasMany('App\Models\Auxilio');
    }

    /**
     * Get the ticket for the user.
     */
    public function ticket()
    {
        return $this->hasMany('App\Models\Ticket','assistido_id');
    }

    /**
     * Get the permissaoAcesso for the user.
     */
    public function permissaoAcesso()
    {
        return $this->hasMany('App\Models\PermissaoAcesso','user_id');
    }

    /**
     * The user assistido associated with ticket
     */
    public function turma()
    {
        return $this->belongsTo('App\Models\Turma');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->formatDate($this->created_at);
    }

    public function getAccessLevelsArray(){
        return $this->levels;
    }

    public function getLevelDescription(){
        if($this->level==100){
            return "GOD MODE";
        }
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

    public function getAvatar(){
        return $this->avatar;
    }

    public function getCodigosPermissaoAcesso(){
        $permissoes = array();
        foreach($this->permissaoAcesso as $permissao){
            $permissoes[] = $permissao->getCodigo();
        }
        return $permissoes;
    }

    public function isArchived(){
        return $this->arquivado;
    }
}
