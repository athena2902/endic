<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Definition extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'definitions';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sense_id', 'title', 'definition'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Relationship: one Definition belong to Sense
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sense()
    {
        return $this->belongsTo(Sense::class, 'sense_id');
    }

    /**
     * Relationship: one Definition has many DefinitionExample
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examples()
    {
        return $this->hasMany(DefinitionExample::class, 'definition_id');
    }
}
