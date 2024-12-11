<?php

namespace App\Http\Controllers\Api;

use App\Models\Section;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ListSectionsRequest;
use App\Http\Resources\SectionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SectionController extends Controller
{
    public function __invoke(ListSectionsRequest $request)
    {
        // Menyimpan hasil pencarian section dengan cache berdasarkan class_id
        $sections = Cache::remember('sections.class_id.' . $request->class_id, now()->addMinutes(2), function () use ($request) {
            return Section::where('class_id', $request->class_id)->get();
        });
        return SectionResource::collection($sections);
    }
}
