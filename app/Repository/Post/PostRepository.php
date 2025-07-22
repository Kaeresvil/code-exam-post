<?php

namespace App\Repository\Post;

use App\Models\Post;
use App\Repository\Base\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

}
