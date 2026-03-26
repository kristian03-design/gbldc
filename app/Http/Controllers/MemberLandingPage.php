<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberLandingPage extends Controller
{
    public function MemberLP()
    {
        // Support both session keys: AuthUser (after OTP login) and user (from redirect)
        $user_account = session('AuthUser') ?? session('user');

        if (!$user_account) {
            return redirect()->route('Member.Login')->with('error', 'Please login first.');
        }

        $webContents = \App\Models\LandingPageContent::where('is_active', true)
            ->whereIn('target_audience', ['member', 'both'])
            ->orderBy('sort_order')
            ->get()
            ->groupBy('section_type');

        return view('Members.MemberLandingPage', compact('user_account', 'webContents'));
    }

    public function MemberLoanPage()
    {
        $user_account = session('AuthUser') ?? session('user');

        if (!$user_account) {
            return redirect()->route('Member.Login')->with('error', 'Please login first.');
        }

        return view('Members.MemberLoanPage', compact('user_account'));
    }

    public function AboutUs()
    {
        $user_account = session('AuthUser') ?? session('user');

        if (!$user_account) {
            return redirect()->route('Member.Login')->with('error', 'Please login first.');
        }

        return view('Members.MemberAboutUs', compact('user_account'));
    }

    public function NewsEvents()
    {
        $user_account = session('AuthUser') ?? session('user');

        if (!$user_account) {
            return redirect()->route('Member.Login')->with('error', 'Please login first.');
        }

        $dbNews = \App\Models\LandingPageContent::where('is_active', true)
            ->whereIn('target_audience', ['member', 'both'])
            ->where('section_type', 'news')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
            
        if($dbNews->count() > 0) {
            $newsEvents = $dbNews->map(function($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'excerpt' => \Illuminate\Support\Str::limit($item->content, 120),
                    'date' => $item->created_at->format('F d, Y'),
                    'category' => 'Updates',
                    'image' => $item->image_path ? $item->image_path : 'images/event1.jpg',
                    'is_featured' => false,
                    'link' => $item->link_url ?? '#'
                ];
            })->toArray();
        } else {
            $newsEvents = app(\App\Http\Controllers\LandingPage::class)->getMockNewsEvents();
        }

        return view('Members.MemberNewsAndEvents', compact('user_account', 'newsEvents'));
    }

    public function Testimonials()
    {
        $user_account = session('AuthUser') ?? session('user');

        if (!$user_account) {
            return redirect()->route('Member.Login')->with('error', 'Please login first.');
        }

        $testimonials = \App\Models\LandingPageContent::where('is_active', true)
            ->whereIn('target_audience', ['member', 'both'])
            ->where('section_type', 'testimonial')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Members.MemberTestimonials', compact('user_account', 'testimonials'));
    }
}
