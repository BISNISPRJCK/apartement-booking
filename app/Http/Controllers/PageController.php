<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        // Data dummy properties untuk home
        $properties = [
            (object)[
                'id' => 1,
                'title' => 'The Grand Suite',
                'type' => 'Luxury Suite',
                'price_min' => 1800000,
                'price_max' => 2500000,
                'city' => 'Jakarta',
                'location' => 'SCBD, Jakarta',
                'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800',
                'is_popular' => true,
                'bedroom' => 3,
                'bathroom' => 3,
                'area' => 185,
            ],
            (object)[
                'id' => 2,
                'title' => 'The Royal Penthouse',
                'type' => 'Penthouse',
                'price_min' => 3200000,
                'price_max' => 4500000,
                'city' => 'Jakarta',
                'location' => 'Kuningan, Jakarta',
                'image' => 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=800',
                'is_popular' => true,
                'bedroom' => 4,
                'bathroom' => 5,
                'area' => 320,
            ],
            (object)[
                'id' => 3,
                'title' => 'The Presidential',
                'type' => 'Presidential Suite',
                'price_min' => 5500000,
                'price_max' => 7500000,
                'city' => 'Jakarta',
                'location' => 'Menteng, Jakarta',
                'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800',
                'is_popular' => false,
                'bedroom' => 5,
                'bathroom' => 6,
                'area' => 450,
            ],
        ];
        
        // Data dummy testimonials
        $testimonials = [
            (object)[
                'id' => 1,
                'name' => 'Alexander Chen',
                'city' => 'CEO, LuxCorp',
                'rating' => 5,
                'message' => 'The epitome of luxury living. Every detail is meticulously crafted, and the service is unparalleled. This is not just a residence; it\'s a lifestyle.',
                'avatar' => 'https://randomuser.me/api/portraits/men/1.jpg',
            ],
            (object)[
                'id' => 2,
                'name' => 'Isabella Rossi',
                'city' => 'Fashion Designer',
                'rating' => 5,
                'message' => 'I\'ve lived in luxury properties worldwide, but Vantix Stay sets a new standard. The attention to detail and privacy is exceptional.',
                'avatar' => 'https://randomuser.me/api/portraits/women/2.jpg',
            ],
            (object)[
                'id' => 3,
                'name' => 'William Hartono',
                'city' => 'Investor',
                'rating' => 5,
                'message' => 'The perfect blend of sophistication and comfort. The amenities are world-class, and the location is unbeatable. Truly a masterpiece.',
                'avatar' => 'https://randomuser.me/api/portraits/men/3.jpg',
            ],
            (object)[
                'id' => 4,
                'name' => 'Natasha Kowalski',
                'city' => 'Art Curator',
                'rating' => 5,
                'message' => 'Living here feels like being in a five-star resort every day. The architecture, the service, the community - everything is perfection.',
                'avatar' => 'https://randomuser.me/api/portraits/women/4.jpg',
            ],
        ];
        
        // Data dummy FAQ
        $faqs = [
            (object)[
                'id' => 1,
                'question' => 'What is the minimum lease period?',
                'answer' => 'The minimum lease period is 12 months for all residences. For the Presidential Suite, we offer flexible terms starting from 6 months.',
            ],
            (object)[
                'id' => 2,
                'question' => 'Are pets allowed?',
                'answer' => 'Yes, we welcome pets in select residences. Additional terms and conditions apply, including a pet deposit.',
            ],
            (object)[
                'id' => 3,
                'question' => 'What amenities are included?',
                'answer' => 'All residents have access to our world-class amenities including infinity pool, fitness center, spa, private lounge, and 24/7 concierge service.',
            ],
            (object)[
                'id' => 4,
                'question' => 'Is parking available?',
                'answer' => 'Yes, each residence comes with dedicated parking spaces. Valet service is also available 24/7.',
            ],
        ];
        
        $apartmentTypes = [
            ['name' => 'Commercial', 'icon' => 'building', 'count' => 10],
            ['name' => 'Warehouse', 'icon' => 'warehouse', 'count' => 10],
            ['name' => 'Villa', 'icon' => 'villa', 'count' => 10],
            ['name' => 'Homestay', 'icon' => 'home', 'count' => 10],
        ];
        
        $cities = ['Jakarta', 'Bandung', 'Yogyakarta', 'Malang', 'Bogor'];
        
        return view('pages.home', compact('properties', 'testimonials', 'faqs', 'apartmentTypes', 'cities'));
    }
    
    public function property(Request $request)
    {
        // Data dummy semua property
        $allProperties = [
            (object)[
                'id' => 1,
                'title' => 'The Grand Suite',
                'type' => 'Luxury Suite',
                'price_min' => 1800000,
                'price_max' => 2500000,
                'city' => 'Jakarta',
                'location' => 'SCBD, Jakarta',
                'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800',
                'is_popular' => true,
                'bedroom' => 3,
                'bathroom' => 3,
                'area' => 185,
                'description' => 'Experience unparalleled luxury in The Grand Suite. Featuring panoramic city views, premium finishes, and state-of-the-art amenities.',
                'facilities' => ['Private Pool', 'Jacuzzi', 'Smart Home System', 'Wine Cellar', 'Private Gym', 'Butler Service'],
            ],
            (object)[
                'id' => 2,
                'title' => 'The Royal Penthouse',
                'type' => 'Penthouse',
                'price_min' => 3200000,
                'price_max' => 4500000,
                'city' => 'Jakarta',
                'location' => 'Kuningan, Jakarta',
                'image' => 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=800',
                'is_popular' => true,
                'bedroom' => 4,
                'bathroom' => 5,
                'area' => 320,
                'description' => 'The Royal Penthouse offers the ultimate in luxury living with two private terraces, a stunning view of the city skyline, and exclusive access to the rooftop lounge.',
                'facilities' => ['Private Terrace', 'Infinity Pool', 'Home Theater', 'Private Elevator', 'Chef\'s Kitchen', 'Wine Cellar'],
            ],
            (object)[
                'id' => 3,
                'title' => 'The Presidential',
                'type' => 'Presidential Suite',
                'price_min' => 5500000,
                'price_max' => 7500000,
                'city' => 'Jakarta',
                'location' => 'Menteng, Jakarta',
                'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800',
                'is_popular' => false,
                'bedroom' => 5,
                'bathroom' => 6,
                'area' => 450,
                'description' => 'The Presidential Suite is the crown jewel of Vantix Stay. Spanning the entire top floor, it features a private spa, library, and breathtaking 360-degree views.',
                'facilities' => ['Private Spa', 'Library', 'Private Garden', 'Indoor Pool', 'Private Cinema', 'Personal Chef'],
            ],
            (object)[
                'id' => 4,
                'title' => 'The Executive Suite',
                'type' => 'Business Suite',
                'price_min' => 1500000,
                'price_max' => 2200000,
                'city' => 'Jakarta',
                'location' => 'Sudirman, Jakarta',
                'image' => 'https://images.unsplash.com/photo-1560185008-5f61a8d770c7?w=800',
                'is_popular' => false,
                'bedroom' => 2,
                'bathroom' => 2,
                'area' => 120,
                'description' => 'Perfect for business executives, this suite offers a dedicated workspace, high-speed internet, and access to the business center.',
                'facilities' => ['Workspace', 'Meeting Room Access', 'High-Speed WiFi', 'Concierge Service'],
            ],
            (object)[
                'id' => 5,
                'title' => 'The Garden Villa',
                'type' => 'Villa',
                'price_min' => 2800000,
                'price_max' => 3800000,
                'city' => 'Bandung',
                'location' => 'Dago, Bandung',
                'image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800',
                'is_popular' => true,
                'bedroom' => 4,
                'bathroom' => 4,
                'area' => 350,
                'description' => 'A private oasis in the heart of the city. This villa features a tropical garden, private swimming pool, and outdoor entertainment area.',
                'facilities' => ['Private Pool', 'Garden', 'Outdoor Kitchen', 'BBQ Area', 'Parking for 4 Cars'],
            ],
            (object)[
                'id' => 6,
                'title' => 'The Sky Residence',
                'type' => 'Premium Apartment',
                'price_min' => 2200000,
                'price_max' => 3100000,
                'city' => 'Jakarta',
                'location' => 'Thamrin, Jakarta',
                'image' => 'https://images.unsplash.com/photo-1574362848149-11496d93a7c7?w=800',
                'is_popular' => false,
                'bedroom' => 3,
                'bathroom' => 3,
                'area' => 210,
                'description' => 'Modern luxury meets comfort in this stunning sky residence. Floor-to-ceiling windows offer spectacular city views.',
                'facilities' => ['Floor-to-Ceiling Windows', 'Modern Kitchen', 'Smart Home', 'Balcony'],
            ],
        ];
        
        // Apply filters
        $properties = collect($allProperties);
        
        if ($request->search) {
            $properties = $properties->filter(function($item) use ($request) {
                return stripos($item->title, $request->search) !== false || 
                       stripos($item->city, $request->search) !== false;
            });
        }
        
        if ($request->type) {
            $properties = $properties->filter(function($item) use ($request) {
                return stripos($item->type, $request->type) !== false;
            });
        }
        
        if ($request->price_range) {
            $range = explode('-', $request->price_range);
            $min = (int)$range[0];
            $max = (int)$range[1];
            $properties = $properties->filter(function($item) use ($min, $max) {
                return $item->price_min >= $min && $item->price_min <= $max;
            });
        }
        
        if ($request->sort == 'price_asc') {
            $properties = $properties->sortBy('price_min');
        } elseif ($request->sort == 'price_desc') {
            $properties = $properties->sortByDesc('price_min');
        } else {
            $properties = $properties->sortByDesc('id');
        }
        
        // Pagination manual
        $perPage = 6;
        $currentPage = request()->get('page', 1);
        $currentItems = $properties->slice(($currentPage - 1) * $perPage, $perPage);
        
        $properties = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentItems,
            $properties->count(),
            $perPage,
            $currentPage,
            ['path' => route('property')]
        );
        
        $apartmentTypes = [
            ['name' => 'Luxury Suite', 'icon' => 'building', 'count' => 5],
            ['name' => 'Penthouse', 'icon' => 'building', 'count' => 3],
            ['name' => 'Presidential Suite', 'icon' => 'building', 'count' => 2],
            ['name' => 'Business Suite', 'icon' => 'building', 'count' => 4],
            ['name' => 'Villa', 'icon' => 'home', 'count' => 3],
            ['name' => 'Premium Apartment', 'icon' => 'building', 'count' => 5],
        ];
        
        return view('pages.property', compact('properties', 'apartmentTypes'));
    }
    
    public function propertyDetail($id)
    {
        // Data dummy detail property
        $properties = [
            1 => (object)[
                'id' => 1,
                'title' => 'The Grand Suite',
                'type' => 'Luxury Suite',
                'price_min' => 1800000,
                'price_max' => 2500000,
                'city' => 'Jakarta',
                'location' => 'SCBD, Jakarta',
                'address' => 'Jl. Jenderal Sudirman Kav. 52, SCBD, Jakarta Selatan',
                'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800',
                'images' => [
                    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800',
                    'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=800',
                    'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800',
                    'https://images.unsplash.com/photo-1560185008-5f61a8d770c7?w=800',
                ],
                'is_popular' => true,
                'bedroom' => 3,
                'bathroom' => 3,
                'area' => 185,
                'description' => 'Experience unparalleled luxury in The Grand Suite. This magnificent residence spans 185 square meters of meticulously designed living space. Featuring panoramic city views, premium Italian marble flooring, and state-of-the-art smart home technology.',
                'long_description' => 'The Grand Suite represents the pinnacle of urban luxury living. Every detail has been carefully considered to create an environment of sophisticated comfort. The open-plan living area flows seamlessly into a gourmet kitchen equipped with Gaggenau appliances. The master suite features a walk-in wardrobe and a spa-inspired bathroom with a freestanding tub and rain shower. Floor-to-ceiling windows throughout the residence frame stunning views of the Jakarta skyline.',
                'facilities' => ['Private Pool', 'Jacuzzi', 'Smart Home System', 'Wine Cellar', 'Private Gym', 'Butler Service', '24/7 Security', 'Valet Parking'],
                'reviews' => [
                    (object)['name' => 'Michael Tan', 'rating' => 5, 'comment' => 'Absolutely stunning! The best apartment I have ever stayed in.', 'date' => '2024-02-15'],
                    (object)['name' => 'Sarah Wijaya', 'rating' => 5, 'comment' => 'Luxury at its finest. The service is impeccable.', 'date' => '2024-01-20'],
                ],
            ],
            2 => (object)[
                'id' => 2,
                'title' => 'The Royal Penthouse',
                'type' => 'Penthouse',
                'price_min' => 3200000,
                'price_max' => 4500000,
                'city' => 'Jakarta',
                'location' => 'Kuningan, Jakarta',
                'address' => 'Jl. HR Rasuna Said Kav. B-12, Kuningan, Jakarta Selatan',
                'image' => 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=800',
                'images' => [
                    'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=800',
                    'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800',
                    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800',
                ],
                'is_popular' => true,
                'bedroom' => 4,
                'bathroom' => 5,
                'area' => 320,
                'description' => 'The Royal Penthouse offers the ultimate in luxury living. Spanning the entire 50th floor, this magnificent residence features two private terraces with stunning views of the city skyline.',
                'long_description' => 'The Royal Penthouse is a masterpiece of architectural design. With 320 square meters of living space, this residence includes four en-suite bedrooms, a formal dining room, and a private elevator entrance. The living room features double-height ceilings and a gas fireplace. The master suite occupies an entire wing and includes a private terrace, walk-in closet, and a bathroom finished in Calacatta marble.',
                'facilities' => ['Private Terrace', 'Infinity Pool', 'Home Theater', 'Private Elevator', 'Chef\'s Kitchen', 'Wine Cellar', 'Private Spa', 'Rooftop Access'],
                'reviews' => [
                    (object)['name' => 'Alexander Chen', 'rating' => 5, 'comment' => 'The views are breathtaking. Truly a one-of-a-kind residence.', 'date' => '2024-02-10'],
                ],
            ],
            3 => (object)[
                'id' => 3,
                'title' => 'The Presidential',
                'type' => 'Presidential Suite',
                'price_min' => 5500000,
                'price_max' => 7500000,
                'city' => 'Jakarta',
                'location' => 'Menteng, Jakarta',
                'address' => 'Jl. HOS Cokroaminoto No. 91, Menteng, Jakarta Pusat',
                'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800',
                'images' => [
                    'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800',
                    'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=800',
                    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800',
                ],
                'is_popular' => false,
                'bedroom' => 5,
                'bathroom' => 6,
                'area' => 450,
                'description' => 'The Presidential Suite is the crown jewel of Vantix Stay. Spanning the entire top floor, it features a private spa, library, and breathtaking 360-degree views.',
                'long_description' => 'The Presidential Suite redefines luxury living. With 450 square meters of exquisitely appointed space, this residence includes five bedrooms, six bathrooms, a private spa with sauna and steam room, a library, and a formal entertainment lounge. The suite also features a private cinema and a gourmet kitchen.',
                'facilities' => ['Private Spa', 'Library', 'Private Garden', 'Indoor Pool', 'Private Cinema', 'Personal Chef', 'Sauna', 'Steam Room'],
                'reviews' => [
                    (object)['name' => 'Isabella Rossi', 'rating' => 5, 'comment' => 'The ultimate luxury experience. Worth every penny.', 'date' => '2024-01-05'],
                ],
            ],
        ];
        
        $property = $properties[$id] ?? null;
        
        if (!$property) {
            abort(404);
        }
        
        return view('pages.property-detail', compact('property'));
    }
    
    public function about()
    {
        $aboutData = [
            'title' => 'About Vantix Stay',
            'description' => 'Vantix Stay is the epitome of luxury living in the heart of Jakarta. Founded in 2024, we have redefined what it means to live in the city.',
            'mission' => 'To provide unparalleled luxury living experiences that exceed the expectations of the world\'s most discerning individuals.',
            'vision' => 'To become the most sought-after luxury residence brand in Southeast Asia.',
            'history' => 'Since our establishment, we have been committed to excellence in every aspect of our service. From the finest materials to the most attentive staff, every detail is carefully curated.',
            'values' => ['Excellence', 'Integrity', 'Innovation', 'Luxury', 'Service'],
            'team' => [
                (object)['name' => 'James Anderson', 'position' => 'CEO & Founder', 'image' => 'https://randomuser.me/api/portraits/men/10.jpg'],
                (object)['name' => 'Maria Gonzalez', 'position' => 'Head of Operations', 'image' => 'https://randomuser.me/api/portraits/women/10.jpg'],
                (object)['name' => 'David Chen', 'position' => 'Chief Architect', 'image' => 'https://randomuser.me/api/portraits/men/11.jpg'],
                (object)['name' => 'Sofia Wijaya', 'position' => 'Interior Design Director', 'image' => 'https://randomuser.me/api/portraits/women/11.jpg'],
            ],
        ];
        
        return view('pages.about', compact('aboutData'));
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
        
        // Simulasi pengiriman pesan (tanpa database)
        return redirect()->back()->with('success', 'Thank you for your message. Our concierge team will contact you within 24 hours.');
    }

    public function testimonials()
    {
        return view('pages.testimonials');
    }
}