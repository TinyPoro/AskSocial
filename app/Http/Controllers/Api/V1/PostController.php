<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Service\PostServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    private $postService;

    public function __construct(
        PostServiceInterface $postService
    ) {
        $this->postService = $postService;
    }

    public function store(Request $request)
    {
        try {
            $params = $request->all();

            $validator = Validator::make($params, [
                'source_id' => 'required|integer',
                'channel_id' => 'required|integer',
                'message' => 'required|string|max:512',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => [
                        'internalMessage' => $validator->errors(),
                        'error_code' => 400,
                        'success' => false,
                    ],
                ], 400);
            }

            $post = $this->postService->createPost($params);

            return response()->json([
                'message' => [
                    'internalMessage' => 'Create post successfully',
                    'error_code' => 200,
                    'success' => true,
                ],
                'data' => $post,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => [
                    'internalMessage' => $e->getMessage(),
                    'error_code' => 500,
                    'success' => false,
                ]
            ], 500);
        }
    }
}
