<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pregunta
 * 
 * @property int $idPregunta
 * @property string $pregunta
 * @property string $respuesta1
 * @property string $respuesta2
 * @property string|null $respuesta3
 * @property string|null $respuesta4
 * @property int $solucion
 * @property string $detalles
 * @property string|null $ayuda
 * @property string|null $definiciones
 * @property int $idCuestionario
 * 
 * @property Cuestionario $cuestionario
 *
 * @package App\Models
 */
class Pregunta extends Model
{
	protected $table = 'preguntas';
	protected $primaryKey = 'idPregunta';
	public $timestamps = false;

	protected $casts = [
		'solucion' => 'int',
		'idCuestionario' => 'int'
	];

	protected $fillable = [
		'pregunta',
		'respuesta1',
		'respuesta2',
		'respuesta3',
		'respuesta4',
		'solucion',
		'detalles',
		'ayuda',
		'definiciones',
		'idCuestionario'
	];

	public function cuestionario()
	{
		return $this->belongsTo(Cuestionario::class, 'idCuestionario');
	}
}
