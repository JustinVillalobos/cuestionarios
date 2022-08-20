<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PuntajePreguntum
 * 
 * @property int $idPuntajes
 * @property int $idPregunta
 * @property int $respuesta
 * @property int $idCuestionario
 * 
 * @property Puntaje $puntaje
 * @property Cuestionario $cuestionario
 *
 * @package App\Models
 */
class PuntajePreguntum extends Model
{
	protected $table = 'puntaje_pregunta';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idPuntajes' => 'int',
		'idPregunta' => 'int',
		'respuesta' => 'int',
		'idCuestionario' => 'int'
	];

	protected $fillable = [
		'idPuntajes' ,
		'idPregunta' ,
		'respuesta',
		'idCuestionario'
	];

	public function puntaje()
	{
		return $this->belongsTo(Puntaje::class, 'idPuntajes');
	}

	public function cuestionario()
	{
		return $this->belongsTo(Cuestionario::class, 'idCuestionario');
	}
}
