<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserOptionResource;
use App\Repository\User\UserRepositoryInterface;
use App\Services\Utils\ResponseServiceInterface;

class UserController extends Controller
{

    private $userRepository;
    private $responseService;
    private $name = "User";

    public function __construct(UserRepositoryInterface $userRepository, ResponseServiceInterface $responseService)
    {
        $this->userRepository = $userRepository;
        $this->responseService = $responseService;
    }

    public function index(Request $request)
    {
        $result = $this->userRepository->list($request->all());
        return $this->responseService->successResponse($this->name, new UserCollection($result));
      
    }


    public function show($id)
    {
        $result = $this->userRepository->find($id);
        if (is_string($result)) {
            return $this->responseService->rejectResponse($result, []);
        }
        return $this->responseService->showResponse($this->name, new UserResource($result));
    }
    

    public function store(UserRequest $request)
    {
        $result = $this->userRepository->create($request->validated());
        if (is_string($result)) {
            return $this->responseService->rejectResponse($result, []);
        }
        return $this->responseService->storeResponse($this->name, new UserResource($result));
    }


    public function update(UserRequest $request, $id)
    {
        $result = $this->userRepository->update($id, $request->validated());
        if (is_string($result)) {
            return $this->responseService->rejectResponse($result, []);
        }
        return $this->responseService->updateResponse($this->name, new UserResource($result));
    }

    public function destroy($id)
    {
        $result = $this->userRepository->delete($id);
        if (is_string($result)) {
              return $this->responseService->rejectResponse($result, []);
        } 
         return $this->responseService->deleteResponse($this->name);
        
    }


   
}
