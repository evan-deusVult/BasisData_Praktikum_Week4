@extends('layouts.app')

@section('content')
<div class="container py-5">

  {{-- Hero Section --}}
  <div class="text-center mb-5">
<span class="badge mb-2 fs-3 
  bg-light text-dark dark:bg-gray-800 dark:text-white border border-gray-300 dark:border-gray-600">
  FTMMTIX - Event & Ticketing Platform
</span>

    <!-- Logo FTMMTIX -->
    <div class="my-3">
      <img src="{{ asset('images/logo-ftmm-tix4.png') }}"
           alt="FTMMTIX Logo"
           width="400"
           class="img-fluid">
    </div>

    {{-- Judul & Subjudul pakai kelas kustom agar warna bisa beda di Light/Dark --}}
    <h1 class="fw-bold hero-title">Find & Join Exciting Events of FTMM</h1>
    <p class="hero-subtitle">
      From academic seminars to basketball matches — book your tickets easily and be part of the experience.
    </p>
  </div>

  {{-- Hero Stats --}}
  <div class="d-flex justify-content-center gap-5 mt-4 text-center">
    <div>
      <h4 class="fw-bold hero-stat-number">{{ $upcomingCount }}</h4>
      <p class="hero-stat-label mb-0">Upcoming Events</p>
    </div>
    <div>
      <h4 class="fw-bold hero-stat-number">{{ $freeCount }}</h4>
      <p class="hero-stat-label mb-0">Free Events</p>
    </div>
    <div>
      <h4 class="fw-bold hero-stat-number">100+</h4>
      <p class="hero-stat-label mb-0">Tickets Sold</p>
    </div>
  </div>

  {{-- Search & Filters --}}
  <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 mt-4">
    <div class="flex-grow-1 me-2">
      <input type="text" class="form-control" placeholder="Search events...">
    </div>
    <div class="dropdown me-2">
      <button class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">All Prices</button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#">All Prices</a></li>
        <li><a class="dropdown-item" href="#">Free</a></li>
        <li><a class="dropdown-item" href="#">Paid</a></li>
      </ul>
    </div>
    <button class="btn btn-outline-secondary"><i class="bi bi-funnel"></i></button>
  </div>

  {{-- Category Filter --}}
  <div class="mb-4">
    <button class="btn btn-dark btn-sm me-2">All</button>
    <button class="btn btn-outline-dark btn-sm me-2">Workshop</button>
    <button class="btn btn-outline-dark btn-sm me-2">Seminar</button>
    <button class="btn btn-outline-dark btn-sm me-2">Sports</button>
    <button class="btn btn-outline-dark btn-sm me-2">Networking</button>
    <button class="btn btn-outline-dark btn-sm me-2">Festival</button>
    <button class="btn btn-outline-dark btn-sm">Other</button>
  </div>

  {{-- Tombol Tambah Event untuk Admin --}}
  @auth
    @if(auth()->user()->role === 'admin')
      <div class="mb-4 text-end">
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
          <i class="bi bi-plus"></i> Tambah Event
        </a>
      </div>
    @endif
  @endauth

  {{-- Event Cards --}}
  <div class="row g-4">
    @php
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
    @endphp

    {{-- Dummy Events --}}
    @foreach($dummyEvents as $event)
      <div class="col-md-6 col-lg-4">
        <div class="event-card h-100">
          <div class="event-thumb-wrap-auto rounded-top">
            <img
              src="{{ asset('images/'.$event['poster']) }}"
              alt="{{ $event['title'] }}"
              class="event-thumb-auto"
            >
          </div>
          <div class="p-3">
            <div class="d-flex justify-content-between mb-2">
              <span class="badge bg-primary">{{ $event['category'] }}</span>
              <span class="badge bg-danger">{{ $event['status'] }}</span>
            </div>
            <h5 class="fw-bold text-dark">{{ $event['title'] }}</h5>
            <ul class="list-unstyled small text-muted mb-3">
              <li><i class="bi bi-calendar-event"></i> {{ $event['date'] }}</li>
              <li><i class="bi bi-clock"></i> {{ $event['time'] }}</li>
              <li><i class="bi bi-geo-alt"></i> {{ $event['location'] }}</li>
              <li><i class="bi bi-people"></i> {{ $event['participants'] }} participants</li>
            </ul>
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <strong class="text-dark">{{ $event['price'] }}</strong><br>
                <small class="text-muted">by {{ $event['organizer'] }}</small>
              </div>
              @if(!auth()->check() && !auth('lecturer')->check() && !auth('user')->check())
                <a href="{{ route('login') }}" class="btn btn-dark btn-sm">Get Ticket</a>
              @else
                <a href="{{ route('order.dummy', ['id' => $event['id']]) }}" class="btn btn-dark btn-sm">Get Ticket</a>
                @php
                  $user = auth('user')->user() ?? auth('lecturer')->user() ?? auth()->user();
                @endphp
                @if($user && $user->role === 'admin')
                  <div class="ms-2 d-flex flex-column gap-1">
                    <a href="{{ route('admin.events.edit', $event['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.events.destroy', $event['id']) }}" method="POST">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </div>
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
    @endforeach

    {{-- Database Events --}}
    @foreach($events as $eventDB)
      @if(is_object($eventDB))
      <div class="col-md-6 col-lg-4">
        <div class="event-card h-100">
          <div class="event-thumb-wrap-auto rounded-top" style="background:#f0f0f0;">
            <img
              src="{{ $eventDB->poster_path ? asset('storage/'.$eventDB->poster_path) : asset('images/default-event.jpg') }}"
              alt="{{ $eventDB->title }}"
              class="event-thumb-auto"
            >
          </div>
          <div class="p-3">
            <div class="d-flex justify-content-between mb-2">
              <span class="badge bg-primary">{{ $eventDB->category ?? 'Event' }}</span>
              <span class="badge bg-danger">{{ $eventDB->status ?? ($eventDB->is_published ? 'Open' : 'Draft') }}</span>
            </div>
            <h5 class="fw-bold text-dark">{{ $eventDB->title }}</h5>
            <ul class="list-unstyled small text-muted mb-3">
              <li><i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($eventDB->start_at)->translatedFormat('F d, Y') }}</li>
              <li><i class="bi bi-clock"></i> {{ $eventDB->start_at ? \Carbon\Carbon::parse($eventDB->start_at)->format('H:i') : '-' }}{{ $eventDB->end_at ? ' - '.\Carbon\Carbon::parse($eventDB->end_at)->format('H:i') : '' }} WIB</li>
              <li><i class="bi bi-geo-alt"></i> {{ $eventDB->venue }}</li>
              <li><i class="bi bi-people"></i> {{ $eventDB->participants ?? '-' }} participants</li>
              <li><i class="bi bi-cash"></i> {{ $eventDB->price == 0 ? 'Free' : 'Rp '.number_format($eventDB->price,0,',','.') }}</li>
            </ul>
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <strong class="text-dark">{{ $eventDB->price == 0 ? 'Free' : 'Rp '.number_format($eventDB->price,0,',','.') }}</strong><br>
                <small class="text-muted">by {{ $eventDB->organizer ?? 'Admin' }}</small>
              </div>
              @if(!auth()->check() && !auth('lecturer')->check() && !auth('user')->check())
                <a href="{{ route('login') }}" class="btn btn-dark btn-sm">Get Ticket</a>
              @else
                <a href="{{ route('order.create', ['id' => $eventDB->id]) }}" class="btn btn-dark btn-sm">Get Ticket</a>
                @php
                  $user = auth('user')->user() ?? auth('lecturer')->user() ?? auth()->user();
                @endphp
                @if($user && $user->role === 'admin')
                  <div class="ms-2 d-flex flex-column gap-1">
                    <a href="{{ route('admin.events.edit', $eventDB->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.events.destroy', $eventDB->id) }}" method="POST">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </div>
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
      @endif
    @endforeach
  </div>

  {{-- Debug Info --}}
  {{----}}
</div>
<script>
const searchInput = document.querySelector('input[placeholder="Search events..."]');
const priceDropdown = document.querySelector('.dropdown-menu');
const priceBtn = document.querySelector('.dropdown-toggle');
const categoryBtns = document.querySelectorAll('.mb-4 .btn');
const eventCards = document.querySelectorAll('.event-card');

let activePrice = 'All Prices';
let activeCategory = 'All';

function filterEvents() {
  const search = searchInput.value.toLowerCase();
  eventCards.forEach(card => {
    const title = card.querySelector('h5').textContent.toLowerCase();
    const priceText = card.querySelector('strong').textContent.toLowerCase();
    const category = card.querySelector('.badge.bg-primary').textContent.toLowerCase();
    let show = true;
    // Search
    if (search && !title.includes(search)) show = false;
    // Price
    if (activePrice === 'Free' && !(priceText.includes('free') || priceText === 'rp 0' || priceText === '0')) show = false;
    if (activePrice === 'Paid' && (priceText.includes('free') || priceText === 'rp 0' || priceText === '0')) show = false;
    // Category
    if (activeCategory !== 'All' && category !== activeCategory.toLowerCase()) show = false;
    card.parentElement.style.display = show ? '' : 'none';
  });
}
searchInput.addEventListener('input', filterEvents);
priceDropdown.querySelectorAll('a').forEach(a => {
  a.addEventListener('click', e => {
    e.preventDefault();
    activePrice = a.textContent.trim();
    priceBtn.textContent = activePrice;
    filterEvents();
  });
});
categoryBtns.forEach(btn => {
  btn.addEventListener('click', e => {
    categoryBtns.forEach(b => b.classList.remove('btn-dark'));
    btn.classList.add('btn-dark');
    activeCategory = btn.textContent.trim();
    filterEvents();
  });
});
// Set default button style for All Prices and All category
priceBtn.textContent = activePrice;
categoryBtns[0].classList.add('btn-dark');
</script>
@endsection
