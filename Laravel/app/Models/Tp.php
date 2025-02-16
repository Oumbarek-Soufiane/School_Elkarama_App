<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Tp
 *
 * @property int $id
 * @property int $module_id
 * @property int $groupe_id
 * @property string $sujet
 * @property string|null $description
 * @property Carbon $dateFin
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Module $module
 * @property Collection|Devoir[] $devoirs
 *
 * @package App\Models
 */
class Tp extends Model
{
    use HasFactory;

	protected $table = 'tps';

	protected $casts = [
		'module_id' => 'int',
		'groupe_id' => 'int',
		'dateFin' => 'datetime'
	];

	protected $fillable = [
		'professeur_id',
		'module_id',
		'groupe_id',
		'sujet',
		'description',
		'dateFin'
	];

	public function module()
	{
		return $this->belongsTo(Module::class);
	}

	public function devoirs()
	{
		return $this->hasMany(Devoir::class);
	}
}
