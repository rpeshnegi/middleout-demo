<?php

namespace App\Repositories\Article;

use App\Repositories\Article\IArticleRepository;
use Illuminate\Support\Facades\DB;

class ArticleRepository implements IArticleRepository
{

    private $tableName = 'articles';
    function __construct()
    {
    }

    public function getAll(string|null $search = null)
    {
        $query = DB::table($this->tableName)
            ->join('users', 'users.id', '=', $this->tableName . '.user_id')
            ->select($this->tableName . '.id', $this->tableName . '.title', $this->tableName . '.published_at', 'users.email')
            ->whereNotNull('published_at')
            ->when($search, function ($query, string $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', '%' . $search . '%');
                    $query->orWhere('body', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('published_at', 'desc');
        // dd($query->toSql());
        return $query->get();
    }

    public function create(mixed $data)
    {
        return DB::table($this->tableName)->insertGetId($data);
    }

    public function destroy(int $id)
    {
        return DB::table($this->tableName)->whereNull('published_at')->where('id', $id)->delete();
    }
}
