<?php

namespace Modules\Influencer\ViewComposers\Dashboard;

use Modules\Influencer\Repositories\Dashboard\TagRepository as Repo;
use Illuminate\View\View;
use Cache;

class TagComposer
{
    public $models = [];

    public function __construct(Repo $repo)
    {
        $this->models =  $repo->getAllActive();
    }

    public function compose(View $view)
    {
        $view->with('tags', $this->models);
    }
}
