<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $idUsuario
 * @property string $usuario
 * @property string $contrasenia
 * @property string $autor
 * 
 * @property Collection|Cuestionario[] $cuestionarios
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuarios';
	protected $primaryKey = 'idUsuario';
	public $timestamps = false;

	protected $fillable = [
		'usuario',
		'contrasenia',
		'autor'
	];

	public function cuestionarios()
	{
		return $this->hasMany(Cuestionario::class, 'autor');
	}
}
