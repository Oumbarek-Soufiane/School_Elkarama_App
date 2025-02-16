<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class GroupeDetail
 *
 * @property int $id
 * @property int $professeur_id
 * @property int $groupe_id
 *
 * @property Groupe $groupe
 * @property Professeur $professeur
 *
 * @package App\Models
 */
class GroupeDetail extends Model
{
    use HasFactory;

	protected $table = 'groupe_details';

	protected $casts = [
		'professeur_id' => 'int',
		'groupe_id' => 'int'
	];

	protected $fillable = [
		'professeur_id',
		'groupe_id'
	];

	public function groupe()
	{
		return $this->belongsTo(Groupe::class);
	}

	public function professeur()
	{
		return $this->belongsTo(Professeur::class);
	}
}
