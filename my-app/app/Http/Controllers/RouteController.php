<?php

namespace App\Http\Controllers;

use App\Models\LandingContent;
use Illuminate\Support\Facades\Cache;

class RouteController extends Controller
{
    public function index()
    {
        $data = Cache::remember('landing_content', 300, function () {
            $contents = LandingContent::query()
                ->active()
                ->orderBy('section')
                ->orderBy('sort_order')
                ->get();

            $grouped = [];
            foreach (LandingContent::SECTIONS as $section) {
                $grouped[$section] = $contents
                    ->where('section', $section)
                    ->values()
                    ->toArray();
            }

            return $grouped;
        });

        // Helper closures exposed to the view for easy lookups
        $find = function (string $section, string $key) use ($data) {
            $items = $data[$section] ?? [];
            foreach ($items as $item) {
                if (($item['item_key'] ?? null) === $key) {
                    return $item;
                }
            }
            return null;
        };

        $get = function (string $section, string $key, string $field = 'content', $default = '') use ($find) {
            $item = $find($section, $key);
            return $item[$field] ?? $default;
        };

        return view('index', [
            'data' => $data,
            'find' => $find,
            'get'  => $get,
            'year' => now()->year,
        ]);
    }
}