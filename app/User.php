<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'no_pegawai';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = []; // -> All atribut mass assignable

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [];

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
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];


    public function bagian()
    {
        return $this->belongsTo('App\bagian', 'id_bagian');
    }

    public function fugnsional()
    {
        return $this->belongsTo('App\fungsional', 'id_fungsional');
    }

    public function golongan()
    {
        return $this->belongsTo('App\golongan', 'id_golongan');
    }

    public function pangkat()
    {
        return $this->belongsTo('App\pangkat', 'id_pangkat');
    }

    public function jabatan()
    {
        return $this->belongsTo('App\jabatan', 'id_jabatan');
    }

}
