<?php

namespace App\View\Components;

use Illuminate\Support\Carbon;
use Illuminate\View\Component;

class UserList extends Component
{
    public $users;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($users)
    {

        $this->users = $users->map(function ($user, $key) {
            $std = Carbon::createFromTimeString($user->created_at);
            $user->key = $key+1;
            $user->created_date = $std->toFormattedDateString();
            $user->created_time = $std->format('g:i:s A');
            return $user;
        });
        ;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.user-list');
    }
}
