<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostRequest;
use App\Http\Resources\Post\PostCollection;
use App\Http\Resources\Post\PostOptionResource;
use App\Http\Resources\Post\PostResource;
use App\Services\Utils\ResponseServiceInterface;
use App\Repository\Post\PostRepositoryInterface;

class PostController extends Controller
{
    private $PostRepository;
    private $responseService;
    private $name = "Post";

    public function __construct(PostRepositoryInterface $PostRepository, ResponseServiceInterface $responseService)
    {
        $this->PostRepository = $PostRepository;
        $this->responseService = $responseService;
    }

       public function index(Request $request)
    {
        $result = $this->PostRepository->list($request->all());
        return $this->responseService->successResponse($this->name, new PostCollection($result));
      
    }


    public function show($id)
    {
        $result = $this->PostRepository->find($id);
        if (is_string($result)) {
            return $this->responseService->rejectResponse($result, []);
        }
        return $this->responseService->showResponse($this->name, new PostResource($result));
    }
    

    public function store(PostRequest $request)
    {
        $result = $this->PostRepository->create($request->validated());
        if (is_string($result)) {
            return $this->responseService->rejectResponse($result, []);
        }
        return $this->responseService->storeResponse($this->name, new PostResource($result));
    }


    public function update(PostRequest $request, $id)
    {
        $result = $this->PostRepository->update($id, $request->validated());
        if (is_string($result)) {
            return $this->responseService->rejectResponse($result, []);
        }
        return $this->responseService->updateResponse($this->name, new PostResource($result));
    }

    public function destroy($id)
    {
        $result = $this->PostRepository->delete($id);
        if (is_string($result)) {
              return $this->responseService->rejectResponse($result, []);
        } 
         return $this->responseService->deleteResponse($this->name);
        
    }

    public function restore($id)
    {
        $result = $this->PostRepository->restore($id);
        if (is_string($result)) {
            return $this->responseService->rejectResponse($result, []);
        }
        return $this->responseService->restoreResponse($this->name);
    }


}
