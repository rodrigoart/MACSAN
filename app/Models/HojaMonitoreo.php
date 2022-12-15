<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HojaMonitoreo extends Model
{
    use HasFactory;

    protected $fillable = [
        'supervisor',
        'id_supervisor',
        'user_id',
        'fecha',
        'actualizado_por',
        'aprovado',
        'aprovado_por',
        'cs',
        'ps',
        'personal_supervisado',
        'cargo',
        'municipio',
        'territorio',
        'observaciones',
    ];

    public function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date("h:ia d/m/Y", strtotime($value)),
        );
    }

    public function photo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? url("storage/$value") : null,
        );
    }

    //relations
    public function insumos(){
        return $this->hasMany(Insumo::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function actualizado(){
        return $this->belongsTo(User::class, 'actualizado_por');
    }

    public function approved(){
        return $this->belongsTo(User::class, 'aprovado_por');
    }

    public function insumos_actualizado(){
        return $this->belongsTo(User::class, 'insumos_actualizado_por');
    }
    // public function user(){
    //     return $this->hasMany(User::class);
    // }
}
