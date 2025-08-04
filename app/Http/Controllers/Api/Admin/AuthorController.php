<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAuthorStoreRequest;
use App\Http\Requests\Admin\AdminAuthorUpdateRequest;
use App\Http\Requests\Admin\AdminBookIndexRequest;
use App\Models\Author;
use App\Services\Admin\AuthorService;

class AuthorController extends Controller
{
    public function index(AdminBookIndexRequest $request)
    {
        $res = AuthorService::index($request);
        return response()->json($res);
    }

    public function store(AdminAuthorStoreRequest $request)
    {
        $res = AuthorService::store($request);
        return response()->json($res);
    }

    public function show(Author $author)
    {
        $res = AuthorService::show($author);
        return response()->json($res);
    }

    public function update(AdminAuthorUpdateRequest $request, Author $author)
    {
        $res = AuthorService::update($request, $author);
        return response()->json($res);
    }

    public function destroy(Author $author)
    {
        $res = AuthorService::destroy($author);
        return response()->json($res);
    }
}
