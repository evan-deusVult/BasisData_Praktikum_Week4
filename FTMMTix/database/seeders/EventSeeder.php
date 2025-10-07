<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Event;
use App\Models\TicketType;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        // daftar event dummy
        $data = [
            [
                'title'      => 'FTMM Tech Expo 2025',
                'location'   => 'Aula FTMM – Kampus C Unair',
                // mulai besok, 09:00–17:00
                'starts_at'  => Carbon::now()->addDay()->setTime(9,0),
                'ends_at'    => Carbon::now()->addDay()->setTime(17,0),
                'poster_url' => 'https://picsum.photos/seed/ftmm-tech-expo/900/400',
                'is_active'  => true,
                'tickets'    => [
                    ['name' => 'Presale', 'price' => 25000, 'quota' => 100],
                    ['name' => 'Reguler', 'price' => 40000, 'quota' => 200],
                    ['name' => 'VIP',     'price' => 100000, 'quota' => 50],
                ],
            ],
            [
                'title'      => 'Data Science Talk: GenAI in Production',
                'location'   => 'Gedung FTMM Lt. 2 – Theater Room',
                'starts_at'  => Carbon::now()->addDays(3)->setTime(13,30),
                'ends_at'    => Carbon::now()->addDays(3)->setTime(16,30),
                'poster_url' => 'https://picsum.photos/seed/genai-talk/900/400',
                'is_active'  => true,
                'tickets'    => [
                    ['name' => 'Mahasiswa', 'price' => 15000, 'quota' => 120],
                    ['name' => 'Umum',      'price' => 35000, 'quota' => 80],
                ],
            ],
            [
                'title'      => 'Workshop UI/UX – Figma Sprint',
                'location'   => 'Lab Komputer FTMM 1',
                'starts_at'  => Carbon::now()->addWeek()->setTime(8,0),
                'ends_at'    => Carbon::now()->addWeek()->setTime(12,0),
                'poster_url' => 'https://picsum.photos/seed/figma-workshop/900/400',
                'is_active'  => true,
                'tickets'    => [
                    ['name' => 'Early Bird', 'price' => 30000, 'quota' => 30],
                    ['name' => 'Reguler',    'price' => 50000, 'quota' => 40],
                ],
            ],
            [
                'title'      => 'FTMM Movie Night: Sci-Fi Marathon',
                'location'   => 'Auditorium FTMM',
                'starts_at'  => Carbon::now()->addDays(10)->setTime(18,30),
                'ends_at'    => Carbon::now()->addDays(10)->setTime(23,30),
                'poster_url' => 'https://picsum.photos/seed/movie-night/900/400',
                'is_active'  => true,
                'tickets'    => [
                    ['name' => 'Reguler', 'price' => 20000, 'quota' => 150],
                    ['name' => 'VIP Sofa', 'price' => 60000, 'quota' => 20],
                ],
            ],
            [
                'title'      => 'Career Fair FTMM',
                'location'   => 'Hall FTMM – Lobi Utama',
                // event berlangsung hari ini (demonstrasi event "sedang berlangsung")
                'starts_at'  => Carbon::now()->setTime(9,0),
                'ends_at'    => Carbon::now()->setTime(16,0),
                'poster_url' => 'https://picsum.photos/seed/career-fair/900/400',
                'is_active'  => true,
                'tickets'    => [
                    ['name' => 'Free Pass', 'price' => 0, 'quota' => 500],
                ],
            ],
            [
                'title'      => 'Alumni Gathering FTMM 2025',
                'location'   => 'Ballroom Hotel Surabaya',
                // event lewat (contoh event lampau → harusnya tidak muncul bila filter is_active & tanggal)
                'starts_at'  => Carbon::now()->subDays(5)->setTime(18,0),
                'ends_at'    => Carbon::now()->subDays(5)->setTime(21,0),
                'poster_url' => 'https://picsum.photos/seed/alumni-gathering/900/400',
                'is_active'  => false,
                'tickets'    => [
                    ['name' => 'Reguler', 'price' => 75000, 'quota' => 0],
                ],
            ],
        ];

        foreach ($data as $e) {
            $slug = Str::slug($e['title']);
            // jika model Event belum auto-slug, generate manual di sini
            /** @var Event $event */
            $event = Event::updateOrCreate(
                ['slug' => $slug],
                [
                    'title'      => $e['title'],
                    'slug'       => $slug,
                    'location'   => $e['location'],
                    'starts_at'  => $e['starts_at'],
                    'ends_at'    => $e['ends_at'],
                    'poster_url' => $e['poster_url'],
                    'is_active'  => $e['is_active'],
                ]
            );

            // ticket types
            foreach ($e['tickets'] as $t) {
                TicketType::updateOrCreate(
                    [
                        'event_id' => $event->id,
                        'name'     => $t['name'],
                    ],
                    [
                        'price' => (int) $t['price'],
                        'quota' => (int) $t['quota'],
                    ]
                );
            }
        }
    }
}
