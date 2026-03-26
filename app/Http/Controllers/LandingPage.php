<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPage extends Controller
{
    public function Landing()
    {
        $webContents = \App\Models\LandingPageContent::where('is_active', true)
            ->whereIn('target_audience', ['guest', 'both'])
            ->orderBy('sort_order')
            ->get()
            ->groupBy('section_type');
            
        return view('guest.GBLDC', compact('webContents'));
    }

    public function LoanPage()
    {
        return view('guest.GuestLoanPage');
    }

    public function AboutUs()
    {
        return view('guest.AboutUs');
    }

    public function Policies()
    {
        return view('guest.policies');
    }

    public function NewsEvents(){
        $dbNews = \App\Models\LandingPageContent::where('is_active', true)
            ->whereIn('target_audience', ['guest', 'both'])
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
            $newsEvents = $this->getMockNewsEvents();
        }

        return view('guest.NewsAndEvents', compact('newsEvents'));
    }

    public function Testimonials(){
        $testimonials = \App\Models\LandingPageContent::where('is_active', true)
            ->whereIn('target_audience', ['guest', 'both'])
            ->where('section_type', 'testimonial')
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('guest.Testimonials', compact('testimonials'));
    }

    public function getMockNewsEvents() {
        return [
            [
                'id' => 1,
                'title' => '22nd Annual General Assembly of Greater Bulacan LDC',
                'excerpt' => 'Held at Cafe De Apati, Makinabang, Baliuag, Bulacan. An engaging discussion on cooperative development and future initiatives for all members.',
                'date' => 'March 22, 2024',
                'category' => 'Events',
                'image' => asset('images/event1.jpg'),
                'is_featured' => true
            ],
            [
                'id' => 2,
                'title' => 'Coop Parade & Launching of Go Koop',
                'excerpt' => 'Empowering cooperatives in celebration of Cooperative Month 2023.',
                'date' => 'August 15, 2025',
                'category' => 'Updates',
                'image' => asset('images/event2.jpg'),
                'is_featured' => false
            ],
            [
                'id' => 3,
                'title' => 'Family Outing and Team Building',
                'excerpt' => 'A day of fun bonding activities to strengthen our cooperative spirit and teamwork.',
                'date' => 'April 12–13, 2025',
                'category' => 'Announcements',
                'image' => asset('images/event3.jpg'),
                'is_featured' => false
            ],
            [
                'id' => 4,
                'title' => 'Koop Kapatid Program',
                'excerpt' => 'A program dedicated to expanding community outreach and cooperative alliances.',
                'date' => 'October 10, 2024',
                'category' => 'Updates',
                'image' => asset('images/event4.jpg'),
                'is_featured' => false
            ]
        ];
    }
}
