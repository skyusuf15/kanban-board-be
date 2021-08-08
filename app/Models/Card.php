<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Card
 * @package App\Models
 *
 * @property string title
 * @property string $description
 * @property int $column_id
 */
class Card extends Model
{
    use HasFactory;

    protected $fillable = [
        "title", "description", "column_id"
    ];

    /**
     * @return BelongsTo
     */
    public function column(): BelongsTo
    {
        return $this->belongsTo('App\Models\Column');
    }
}
