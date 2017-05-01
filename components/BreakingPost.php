<?php namespace SGDInstitute\BreakingNews\Components;

use Carbon\Carbon;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Post as BlogPost;
use RainLab\Blog\Models\Category as BlogCategory;

class BreakingPost extends ComponentBase
{
    /**
     * @var RainLab\Blog\Models\Post The post model used for display.
     */
    public $breakingPost;

    /**
     * @var string Reference to the page name for linking to categories.
     */
    public $categoryPage;

    public function componentDetails()
    {
        return [
            'name'        => 'Breaking News',
            'description' => 'Show one post.',
        ];
    }

    public function onRun()
    {
        $this->breakingPost = $this->page['breakingPost'] = $this->loadPost();
    }

    protected function loadPost()
    {
        $category = BlogCategory::where('slug', 'breaking')->first();
        $posts = BlogPost::where('published_at', ">=", Carbon::now()->subWeeks(3))->orderBy('published_at', 'desc')->get();
        $filtered = [];
        foreach ($posts as $post) {
            if (in_array('breaking', $post->categories()->lists('slug'))) {
                $filtered[] = $post;
            }
        }

        return (isset($filtered[0])) ? $filtered[0] : null;
    }
}
