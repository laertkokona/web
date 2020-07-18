  
<?php

class Post
{
    var $id;
    var $user_id;
    var $category_id;
    var $title;
    var $image;
    var $body;
    var $published;
    var $created_ad;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->user_id = $args['user_id'] ?? '';
        $this->category_id = $args['category_id'] ?? '';
        $this->title = $args['title'] ?? '';
        $this->image = $args['image'] ?? '';
        $this->body = $args['body'] ?? '';
        $this->published = $args['published'] ?? '';
        $this->content = $args['content'] ?? '';
    }
}