<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LandingPageContent;
use Illuminate\Support\Facades\File;

class WebContentController extends Controller
{
    public function index()
    {
        $contents = LandingPageContent::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        // Group by section type for easier rendering in the view
        $groupedContents = $contents->groupBy('section_type');
        
        return view('Administrator.AdminWebContent', compact('groupedContents', 'contents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'target_audience' => 'required|string',
            'section_type' => 'required|string',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'content' => 'nullable|string',
            'link_url' => 'nullable|string',
            'icon_class' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('images/landing_content');
            if(!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
            $file->move($path, $filename);
            $data['image_path'] = 'images/landing_content/' . $filename;
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->has('is_active') ? $request->is_active : 1;

        LandingPageContent::create($data);

        return back()->with('success', 'Content added successfully.');
    }

    public function update(Request $request, $id)
    {
        $contentItem = LandingPageContent::findOrFail($id);

        $data = $request->validate([
            'target_audience' => 'required|string',
            'section_type' => 'required|string',
            'title' => 'nullable|string',
            'subtitle' => 'nullable|string',
            'content' => 'nullable|string',
            'link_url' => 'nullable|string',
            'icon_class' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($contentItem->image_path && File::exists(public_path($contentItem->image_path))) {
                File::delete(public_path($contentItem->image_path));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('images/landing_content');
            if(!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
            $file->move($path, $filename);
            $data['image_path'] = 'images/landing_content/' . $filename;
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->has('is_active') ? $request->is_active : 1;

        $contentItem->update($data);

        return back()->with('success', 'Content updated successfully.');
    }

    public function destroy($id)
    {
        $contentItem = LandingPageContent::findOrFail($id);

        if ($contentItem->image_path && File::exists(public_path($contentItem->image_path))) {
            File::delete(public_path($contentItem->image_path));
        }

        $contentItem->delete();

        return back()->with('success', 'Content deleted successfully.');
    }
}
