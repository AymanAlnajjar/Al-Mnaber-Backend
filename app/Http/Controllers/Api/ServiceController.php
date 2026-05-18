<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Get all active services
     */
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->map(function ($service) {
                return [
                    'id' => $service->id,
                    'title_en' => $service->title_en,
                    'title_ar' => $service->title_ar,
                    'description_en' => $service->description_en,
                    'description_ar' => $service->description_ar,
                    'details_en' => $service->details_en,
                    'details_ar' => $service->details_ar,
                    'icon' => $service->icon ? asset('storage/' . $service->icon) : null,
                    'background_image' => $service->background_image ? asset('storage/' . $service->background_image) : null,
                    'sort_order' => $service->sort_order,
                ];
            });

        return response()->json($services);
    }

    /**
     * Get single service with SEO payload
     */
    public function show(string $id)
    {
        $service = Service::where('is_active', true)->find($id);

        if (!$service) {
            return response()->json(['error' => 'Service not found'], 404);
        }

        return response()->json([
            'id' => $service->id,
            'title_en' => $service->title_en,
            'title_ar' => $service->title_ar,
            'description_en' => $service->description_en,
            'description_ar' => $service->description_ar,
            'details_en' => $service->details_en,
            'details_ar' => $service->details_ar,
            'icon' => $service->icon ? asset('storage/' . $service->icon) : null,
            'background_image' => $service->background_image ? asset('storage/' . $service->background_image) : null,
            'seo' => [
                'meta_title_en' => $service->meta_title_en,
                'meta_title_ar' => $service->meta_title_ar,
                'meta_description_en' => $service->meta_description_en,
                'meta_description_ar' => $service->meta_description_ar,
                'meta_keywords_en' => is_array($service->meta_keywords_en)
                    ? implode(', ', $service->meta_keywords_en)
                    : ($service->meta_keywords_en ?? ''),
                'meta_keywords_ar' => is_array($service->meta_keywords_ar)
                    ? implode(', ', $service->meta_keywords_ar)
                    : ($service->meta_keywords_ar ?? ''),
                'slug_en' => $service->slug_en,
                'slug_ar' => $service->slug_ar,
                'og_image' => $service->background_image
                    ? asset('storage/' . $service->background_image)
                    : null,
            ],
        ]);
    }
}
