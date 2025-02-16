<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Professeur
 *
 * @property int $id
 * @property int $user_id
 * @property string $diplome
 * @property Carbon $dateEmbauche
 * @property float $salaire
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|GroupeDetail[] $groupes_details
 * @property Collection|Module[] $modules
 *
 * @package App\Models
 */
class Professeur extends Model
{
    use HasFactory;

	protected $table = 'professeurs';

	protected $casts = [
		'user_id' => 'int',
		'dateEmbauche' => 'date',
		'salaire' => 'float'
	];

	protected $fillable = [
		'user_id',
		'diplome',
		'dateEmbauche',
		'salaire'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function groupes_details()
	{
		return $this->hasMany(GroupeDetail::class);
	}

	public function modules()
	{
		return $this->hasMany(Module::class);
	}
}
