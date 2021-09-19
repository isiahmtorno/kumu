<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\GitHub\Facade\GitHub;
use App\Models\Log;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class GitHubController extends Controller
{
    private const CACHE_KEY_PREFIX = 'github-';
    private const CACHE_TIME_OUT = 120;

    public function __invoke(Request $request): JsonResponse
    {
        $response_data = [];

        foreach (array_filter($request->usernames) as $username) {
            $cache_key = self::CACHE_KEY_PREFIX . $username . '-' . 1;
            $source = Cache::has($cache_key) ? Log::SOURCE_REDIS : Log::SOURCE_API;

            $response = Cache::remember($cache_key, self::CACHE_TIME_OUT, function () use ($username) {
                return GitHub::getGitHubInformation($username);
            });

            $data = $this->getData($response);

            Log::create([
                'user_id' => Auth::id(),
                'source' => $source,
                'data' => $data,
                'response' => $this->getResponse($response),
            ]);

            $response_data[] = $data;
        }

        return response()->json($this->getResponseData(array_filter($response_data)));
    }

    private function getData($response): ?string
    {
        $value = $response->getValue();
        $response_code = $response->getResponseCode();

        if ($response_code === Response::HTTP_OK) {
            return json_encode([
                'name' => $value['name'],
                'login' => $value['login'],
                'company' => $value['company'],
                'followers' => $value['followers'],
                'public_repos' => $value['public_repos'],
                'average_followers' => round($value['followers'] / $value['public_repos']),
            ]);
        }

        return null;
    }

    private function getResponse($response): string
    {
        return json_encode([
            'status' => $response->getResponseCode(),
            'message' => $response->getValue(),
        ]);
    }

    private function getResponseData(array $response_data): array
    {
        $response = [];

        foreach ($response_data as $data) {
            $response[] = json_decode($data, true);
        }

        // sort alphabetically by name
        usort($response, function (array $a, array $b) {
            return $a['name'] <=> $b['name'];
        });

        return $response;
    }
}
