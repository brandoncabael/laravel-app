<?php

namespace App\Policies;

use App\Todo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TodoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any todos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the todo.
     *
     * @param  \App\User  $user
     * @param  \App\Todo  $todo
     * @return mixed
     */
    public function view(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id
                    ? Response::allow()
                    : Response::deny('You do not own this todo');
    }

    /**
     * Determine whether the user can create todos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the todo.
     *
     * @param  \App\User  $user
     * @param  \App\Todo  $todo
     * @return mixed
     */
    public function update(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id
                    ? Response::allow()
                    : Response::deny('You do not own this todo');
    }

    /**
     * Determine whether the user can delete the todo.
     *
     * @param  \App\User  $user
     * @param  \App\Todo  $todo
     * @return mixed
     */
    public function delete(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id
                    ? Response::allow()
                    : Response::deny('You do not own this todo');
    }

    /**
     * Determine whether the user can restore the todo.
     *
     * @param  \App\User  $user
     * @param  \App\Todo  $todo
     * @return mixed
     */
    public function restore(User $user, Todo $todo)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the todo.
     *
     * @param  \App\User  $user
     * @param  \App\Todo  $todo
     * @return mixed
     */
    public function forceDelete(User $user, Todo $todo)
    {
        return false;
    }
}
