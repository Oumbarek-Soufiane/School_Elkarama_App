<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Filiere
 *
 * @property int $id
 * @property string $designation
 * @property string $emploieDuTemps
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Groupe[] $groupes
 * @property Collection|Module[] $modules
 *
 * @package App\Models
 */
class Filiere extends Model
{
    use HasFactory;

	protected $table = 'filieres';

	protected $fillable = [
		'designation',
		'emploieDuTemps'
	];

	public function groupes()
	{
		return $this->hasMany(Groupe::class);
	}

	public function modules()
	{
		return $this->hasMany(Module::class);
	}
}
