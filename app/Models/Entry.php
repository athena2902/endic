<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entries';

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
    protected $fillable = [
        'word_id', 'type', 'voice_uk_1', 'voice_us_1', 'voice_uk_2', 'voice_us_2',
        'ipa_uk_1', 'ipa_us_1', 'ipa_uk_2', 'ipa_us_2', 'image', 'wikipedia'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Relationship: one Entry belong to Word
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function word()
    {
        return $this->belongsTo(Word::class, 'word_id');
    }

    /**
     * Relationship: one Entry has many Sense
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function senses()
    {
        return $this->hasMany(Sense::class, 'entry_id');
    }

    /**
     * Relationship: one Entry has many Definition
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function definitions()
    {
        return $this->hasMany(Definition::class, 'entry_id');
    }

    /**
     * Relationship: one Entry has many Example
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function examples()
    {
        return $this->hasMany(Example::class, 'entry_id');
    }

    /**
     * Relationship: one Entry belong to WordClass
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wordClass()
    {
        $this->belongsTo(WordClass::class, 'type');
    }
}
