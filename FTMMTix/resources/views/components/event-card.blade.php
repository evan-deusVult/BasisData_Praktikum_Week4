@php
    $availableTickets = $event->capacity - $event->registered;
    $isAlmostFull = $availableTickets <= $event->capacity * 0.2;
@endphp

<div class="overflow-hidden hover:shadow-md transition-shadow cursor-pointer group bg-card text-card-foreground rounded-lg border"
     @click="selectEvent({{ $event->toJson() }})">
    
    <div class="aspect-video relative overflow-hidden">
        <img src="{{ $event->image ?: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=600&h=400&fit=crop' }}" 
             alt="{{ $event->title }}" 
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
        
        <div class="absolute top-3 left-3">
            <span class="inline-flex items-center rounded-md px-2.5 py-0.5 text-xs font-medium
                @if($event->category === 'Workshop') bg-primary text-primary-foreground
                @elseif($event->category === 'Seminar') bg-secondary text-secondary-foreground
                @else bg-background text-foreground border @endif">
                {{ $event->category }}
            </span>
        </div>
        
        @if($isAlmostFull)
            <div class="absolute top-3 right-3">
                <span class="inline-flex items-center rounded-md bg-destructive px-2.5 py-0.5 text-xs font-medium text-destructive-foreground">
                    Almost Full
                </span>
            </div>
        @endif
    </div>
    
    <div class="p-4">
        <div class="space-y-3">
            <div>
                <h3 class="line-clamp-2">{{ $event->title }}</h3>
                <p class="text-muted-foreground text-sm mt-1 line-clamp-2">
                    {{ $event->description }}
                </p>
            </div>
            
            <div class="space-y-2">
                <div class="flex items-center text-sm text-muted-foreground">
                    <svg class="h-4 w-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span>{{ $event->date->format('F j, Y') }}</span>
                </div>
                
                <div class="flex items-center text-sm text-muted-foreground">
                    <svg class="h-4 w-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ $event->time }}</span>
                </div>
                
                <div class="flex items-center text-sm text-muted-foreground">
                    <svg class="h-4 w-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ $event->location }}</span>
                </div>
                
                <div class="flex items-center text-sm text-muted-foreground">
                    <svg class="h-4 w-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    <span>{{ $event->registered }}/{{ $event->capacity }} participants</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="p-4 pt-0 flex items-center justify-between">
        <div class="flex flex-col">
            <span class="text-2xl font-medium">
                @if($event->price == 0)
                    FREE
                @else
                    Rp {{ number_format($event->price, 0, ',', '.') }}
                @endif
            </span>
            <span class="text-xs text-muted-foreground">by {{ $event->organizer }}</span>
        </div>
        
        <button class="inline-flex items-center justify-center rounded-md bg-primary px-3 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90 disabled:pointer-events-none disabled:opacity-50"
                @if($availableTickets === 0) disabled @endif>
            @if($availableTickets === 0)
                Sold Out
            @else
                Get Ticket
            @endif
        </button>
    </div>
</div>