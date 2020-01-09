<?php

namespace MitaJunior\Workflow\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Workflow extends Model {

    protected $table = 'm_workflows';

    protected $fillable = ['name', 'type', 'description'];

    protected $casts = [
        'active' => "boolean"
    ];

    public function stages()
    {
        return $this->hasMany(Stage::class, 'workflow_id');
    }

    /**
     * Get all available workflow types
     *
     * @param null $name
     * @return Collection|mixed
     */
    public static function getTypes($name = null)
    {
        $types = collect(config('workflow.types'));
        if(!$name)
            return $types->toArray();

        return $types->where('name', $name)->first();
    }
}