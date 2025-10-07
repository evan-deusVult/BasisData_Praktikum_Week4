<div x-show="isModalOpen" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 bg-black/80"
     style="display: none;">
    
    <div class="fixed left-[50%] top-[50%] z-50 grid w-full max-w-2xl translate-x-[-50%] translate-y-[-50%] gap-4 border bg-background p-6 shadow-lg duration-200 sm:rounded-lg"
         x-show="isModalOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         @click.away="closeModal()">
        
        <div class="flex flex-col space-y-1.5 text-center sm:text-left">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold">Event Registration</h2>
                <button @click="closeModal()" 
                        class="rounded-sm opacity-70 ring-offset-background transition-opacity hover:opacity-100">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="max-h-[90vh] overflow-y-auto">
            <div class="space-y-6" x-show="selectedEvent">
                <!-- Event Info -->
                <div class="space-y-4">
                    <div class="aspect-video relative rounded-lg overflow-hidden">
                        <img :src="selectedEvent?.image" 
                             :alt="selectedEvent?.title" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center rounded-md bg-primary px-2.5 py-0.5 text-xs font-medium text-primary-foreground"
                                  x-text="selectedEvent?.category"></span>
                        </div>
                    </div>

                    <div>
                        <h2 x-text="selectedEvent?.title"></h2>
                        <p class="text-muted-foreground mt-1" x-text="selectedEvent?.description"></p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center text-sm">
                            <svg class="h-4 w-4 mr-2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span x-text="selectedEvent?.date"></span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="h-4 w-4 mr-2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span x-text="selectedEvent?.time"></span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="h-4 w-4 mr-2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span x-text="selectedEvent?.location"></span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="h-4 w-4 mr-2 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            <span x-text="(selectedEvent?.capacity - selectedEvent?.registered) + ' tickets left'"></span>
                        </div>
                    </div>
                </div>

                <hr class="border-border">

                <!-- Registration Form -->
                <form @submit.prevent="submitRegistration()" class="space-y-4">
                    <h3>Registration Information</h3>
                    
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="name" class="text-sm font-medium">Full Name *</label>
                            <input type="text" 
                                   id="name" 
                                   x-model="formData.name"
                                   placeholder="Enter your full name"
                                   class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                   required>
                        </div>
                        
                        <div>
                            <label for="email" class="text-sm font-medium">Email *</label>
                            <input type="email" 
                                   id="email" 
                                   x-model="formData.email"
                                   placeholder="Enter your email"
                                   class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                   required>
                        </div>
                        
                        <div>
                            <label for="phone" class="text-sm font-medium">Phone Number *</label>
                            <input type="tel" 
                                   id="phone" 
                                   x-model="formData.phone"
                                   placeholder="Enter your phone number"
                                   class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"
                                   required>
                        </div>
                        
                        <div>
                            <label for="university" class="text-sm font-medium">University/Institution</label>
                            <input type="text" 
                                   id="university" 
                                   x-model="formData.university"
                                   placeholder="Enter your university"
                                   class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full inline-flex items-center justify-center rounded-md bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90 h-11">
                        <span x-text="selectedEvent?.price === 0 ? 'Register Now' : 'Purchase Tickets'"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>