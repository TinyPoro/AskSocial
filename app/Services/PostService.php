<?php
/**
 * Created by PhpStorm.
 * User: TinyPoro
 * Date: 1/16/20
 * Time: 3:50 PM
 */

namespace App\Service;


use App\Repositories\PostRepositoryInterface;
use App\Services\ExternalApiServiceInterface;

class PostService implements PostServiceInterface
{
    private $postRepository;

    private $externalApiService;

    public function __construct(
        PostRepositoryInterface $postRepository,
        ExternalApiServiceInterface $externalApiService
    ) {
        $this->postRepository = $postRepository;
        $this->externalApiService = $externalApiService;
    }

    public function createPost(array $params)
    {
        $sourceId = $params['source_id'];

        $source = $this->externalApiService->getSourceDetail($sourceId);

        return $this->postRepository->create($params);
    }
}