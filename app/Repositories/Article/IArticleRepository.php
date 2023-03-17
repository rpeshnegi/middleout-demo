<?php

namespace App\Repositories\Article;


interface IArticleRepository
{
    public function getAll(string|null $search = null);
    public function create(mixed $data);
    public function destroy(int $id);
}
