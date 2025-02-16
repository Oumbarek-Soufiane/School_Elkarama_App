<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Tuteur
 *
 * @property int $id
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|TuteurDetail[] $tuteur_details
 *
 * @package App\Models
 */
class Tuteur extends Model
{
    use HasFactory;

    protected $table = 'tuteurs';

    protected $casts = [
        'user_id' => 'int'
    ];

    protected $fillable = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tuteur_details()
    {
        return $this->hasMany(TuteurDetail::class);
    }
}
