<?php namespace Barrel\Entities;

use Barrel\Database\Model;
use Illuminate\Support\Collection;

class Role extends Model {

    public static $rules = [
        'name' => 'required|unique:roles,name,:id|min:4',
        'parent_id' => 'numeric'
    ];

    /**
     * A role can be associated with many users.
     *
     * @return mixed
     */
    public function users()
    {
        return $this->belongsToMany('User');
    }

    /**
     * Return the roles parent role.
     * All roles lead back to the admin parent eventually.
     *
     * @return mixed
     */
    public function parent()
    {
        return static::find($this->parent_id);
    }

    /**
     * Return all roles that can override the current role.
     *
     * @return Collection
     */
    public function parents()
    {
        $parent = $this->parent();
        $parents = [];

        while ($parent->parent_id) {
            $parent = static::find($parent->parent_id);
            $parents[] = $parent;
        }

        return new Collection($parents);
    }

}