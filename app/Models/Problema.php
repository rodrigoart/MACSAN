<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problema extends Model
{
    use HasFactory;

    protected $fillable = [
        'minuta_id',
        'user_id',
        'descripcion',
        'responsable',
        'causas',
        'acciones',
        'recursos',
        'fecha_aplicacion',
        'fecha_solucionado',
        'logros',
        'solucionado',
    ];

    public function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date("h:ia d/m/Y", strtotime($value)),
        );
    }

    //relations
    public function minuta(){
        return $this->belongsTo(Minuta::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }
}

            // $table->unsignedBigInteger('minuta_id');
            // $table->string('responsable');
            // $table->string('causas');
            // $table->string('acciones');
            // $table->date('fecha_aplicacion');
            // $table->text('logros');
            // $table->timestamps();
