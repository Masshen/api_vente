<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Article extends Component
{
    public $title;
    public $description;
    public $icon;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title,$description,$icon)
    {
        $this->title=$title;
        $this->description=$description;
        $this->icon=$icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.article');
    }
}
