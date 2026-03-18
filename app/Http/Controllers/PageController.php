<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Testimonial;
use App\Models\Faq;

class PageController extends Controller
{
    public function home()
    {
        $properties = Property::latest()->take(3)->get();
        $testimonials = Testimonial::latest()->take(3)->get();
        $faqs = Faq::latest()->take(4)->get();
        
        $apartmentTypes = [
            ['name' => 'Commercial', 'icon' => 'building', 'count' => 10],
            ['name' => 'Warehouse', 'icon' => 'warehouse', 'count' => 10],
            ['name' => 'Villa', 'icon' => 'villa', 'count' => 10],
            ['name' => 'Homestay', 'icon' => 'home', 'count' => 10],
        ];
        
        $cities = ['Jakarta', 'Bandung', 'Yogyakarta', 'Malang', 'Bogor'];
        
        return view('pages.home', compact('properties', 'testimonials', 'faqs', 'apartmentTypes', 'cities'));
    }
    
    public function property()
    {
        $properties = Property::paginate(9);
        return view('pages.property', compact('properties'));
    }
    
    public function propertyDetail($id)
    {
        $property = Property::findOrFail($id);
        return view('pages.property-detail', compact('property'));
    }
    
    public function about()
    {
        return view('pages.about');
    }
    
    public function contact()
    {
        return view('pages.contact');
    }
    
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        
        // Kirim email atau simpan ke database
        // Mail::to('admin@vantix.com')->send(new ContactMessage($validated));
        
        return redirect()->back()->with('success', 'Pesan Anda telah terkirim!');
    }
}