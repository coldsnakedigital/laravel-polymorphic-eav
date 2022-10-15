<?php

namespace ColdsnakeDigital\LaravelPolymorphicEav\Resolvers;

use ColdsnakeDigital\LaravelPolymorphicEav\Traits\HasEntityAttributeValues;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GroupResolver
{
    /**
     * @var Model
     */
    public $model;

    /**
     * Resolver constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param string|null $group
     *
     * @return Collection
     */
    public function getProperties(?string $group = null): Collection
    {
        $instance = (new class { use HasEntityAttributeValues; });
        return $this->model
            ->{$instance::$relationName}
            ->when($group, function (Collection $properties) use ($group, $instance) {
                return $properties->where($instance::$attributeGroup, $group);
            });
    }

    /**
     * @param string $group
     *
     * @return Resolver
     */
    public function __get(string $group): Resolver
    {
        return new Resolver($this, $group);
    }
}
