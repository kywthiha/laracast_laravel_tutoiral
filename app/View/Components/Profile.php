<?php

namespace App\View\Components;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Profile extends Component
{
    public $user;

    /**
     * Create a new component instance.
     *
     * @param null $user
     */
    public function __construct($user=null)
    {
        if($user)
        {
            $this->user = $user;
        }
        else{
            $this->user = Auth::user();
        }
        if($this->user->updated_at->eq($this->user->created_at)){
            $this->user->updated_at = null;
        }
    }

    public function register_at(){
        return $this->user->created_at->toDayDateTimeString();
    }

    public function assign_role_at()
    {
        $temp = $this->user->updated_at;
        return $temp?$temp->toDayDateTimeString():null;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.profile');
    }
}
