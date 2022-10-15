<?php

namespace ColdsnakeDigital\LaravelPolymorphicEav\Scopes;

use ColdsnakeDigital\LaravelPolymorphicEav\EntityAttribute;
use Illuminate\Database\Eloquent\Builder;

/**
 * Trait EntityAttributeValueScopes
 * @package ColdsnakeDigital\LaravelPolymorphicEav\Scopes
 *
 * @method static hasAttribute(EntityAttribute|int $attribute) Get instances with a given attribute
 */
trait EntityAttributeValueScopes
{
    /**
     * Get instances with a given attribute
     *
     * @param Builder $query
     * @param $attribute
     *
     * @return Builder
     */
    public function scopeHasAttribute(Builder $query, $attribute): Builder
    {
        $attributeId = ($attribute instanceof EntityAttribute) ? $attribute->id : $attribute;

        return $query->whereHas(static::$relationName, function (Builder $query) use ($attributeId) {
            $query->where('entity_attribute_id', $attributeId);
        });
    }

    /**
     * Get instances with a given entity, attribute and value
     *
     * @param Builder $query
     * @param $entity
     * @param $attribute
     * @param $value
     *
     * @return Builder
     */
    public function scopeWithEAV(Builder $query, $entity, $attribute, $value): Builder
    {
        $attributeId = ($attribute instanceof EntityAttribute) ? $attribute->id : $attribute;

        $entityId = (isset($entity->id)) ? $entity->id : $entity;

        return $query->whereHas(static::$relationName, function (Builder $query) use ($entityId, $attributeId, $value) {
            $query->where('entity_id', $entityId)->where('entity_attribute_id', $attributeId)->where('value', 'LIKE', '%'.$value.'%');
        });
    }
}
