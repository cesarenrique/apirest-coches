<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Provincia;
use App\Hotel;
use App\Transformers\LocalidadTransformer;

class Localidad extends Model
{
  use Notifiable,SoftDeletes;

  public $transformer= LocalidadTransformer::class;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $dates=['deleted_at'];
  protected $fillable = [
      'id',
      'nombre',
      'Provincia_id',
  ];

  public function provincia(){
    return $this->belongsTo(Provincia::class);
  }

  public function hotels(){
    return $this->hasMany(Hotel::class);
  }
}
