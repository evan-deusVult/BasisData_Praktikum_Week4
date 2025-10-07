<?php
namespace App\Http\Controllers;
use App\Models\Event;

class HomeController extends Controller
{
        public function index(){
                $events = Event::where('is_published',true)
                        ->where('start_at','>=',now()->subDay())
                        ->orderBy('start_at')
                        ->get();
                $dummyEvents = [
                        [
                            'id' => 1,
                            'title' => 'Basket FTMM Championship',
                            'poster' => 'basket-ftmm.jpg',
                            'category' => 'Sports',
                            'status' => 'Almost Full',
                            'date' => 'Mei 18, 2025',
                            'time' => '16:00 - 17.00 WIB',
                            'location' => 'GOR FTMM',
                            'participants' => '80/100',
                            'price' => 'Rp 25.000',
                            'organizer' => 'FTMM Sports Club',
                        ],
                        [
                            'id' => 2,
                            'title' => 'Internship Duta FTMM',
                            'poster' => 'internship-duta-ftmm.jpg',
                            'category' => 'Networking',
                            'status' => 'Open',
                            'date' => 'September 12-19, 2025',
                            'time' => '09:00 - 12:00 WIB',
                            'location' => 'Auditorium FTMM',
                            'participants' => '200/300',
                            'price' => 'Free',
                            'organizer' => 'FTMM Duta Team',
                        ],
                        [
                            'id' => 3,
                            'title' => 'Festival Petasan Kreatif',
                            'poster' => 'petasan.jpg',
                            'category' => 'Festival',
                            'status' => 'Limited',
                            'date' => 'August 17, 2025',
                            'time' => '15:00 WIB',
                            'location' => 'Lapangan FTMM',
                            'participants' => '200/200',
                            'price' => 'Rp 50.000',
                            'organizer' => 'FTMM Sports & Arts',
                        ],
                ];
                                $upcomingCount = count($dummyEvents) + $events->count();
                                $freeDummy = collect($dummyEvents)->filter(function($e){
                                        return strtolower($e['price']) === 'free' || $e['price'] == 0;
                                })->count();
                                $freeDb = $events->where('price', 0)->count();
                                $freeCount = $freeDummy + $freeDb;
                                return view('home', compact('events', 'dummyEvents', 'upcomingCount', 'freeCount'));
        }
}


