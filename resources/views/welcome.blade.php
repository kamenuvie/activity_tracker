<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Daily~Track - Professional activity tracking system for NSS personnel. Track tasks, monitor progress, and generate reports efficiently.">
    <meta name="keywords" content="activity tracker, task management, NSS, Daily Track, productivity">
    <title>Daily~Track - NSS Activity Tracking System</title>

    <!-- Performance: DNS Prefetch & Preconnect -->
    <link rel="dns-prefetch" href="https://fonts.bunny.net">
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>

    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" x-data="{
    showOnboarding: !localStorage.getItem('onboardingCompleted'),
    currentStep: 1,
    totalSteps: 5,
    nextStep() {
        if (this.currentStep < this.totalSteps) {
            this.currentStep++;
        } else {
            this.completeOnboarding();
        }
    },
    prevStep() {
        if (this.currentStep > 1) {
            this.currentStep--;
        }
    },
    completeOnboarding() {
        localStorage.setItem('onboardingCompleted', 'true');
        this.showOnboarding = false;
    },
    skipOnboarding() {
        localStorage.setItem('onboardingCompleted', 'true');
        this.showOnboarding = false;
    }
}"
>
    <!-- Onboarding Modal Overlay -->
    <div x-show="showOnboarding"
         x-cloak
         class="fixed inset-0 z-[100] overflow-y-auto"
         style="display: none;">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal Container -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div @click.away="false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full p-8">

                <!-- Progress Indicator -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-gray-600">Step <span x-text="currentStep"></span> of <span x-text="totalSteps"></span></span>
                        <button @click="skipOnboarding()" class="text-sm text-gray-500 hover:text-gray-700">Skip Tour</button>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-nss-green-500 to-nss-green-600 h-2 rounded-full transition-all duration-300"
                             :style="'width: ' + (currentStep / totalSteps * 100) + '%'"></div>
                    </div>
                </div>

                <!-- Step 1: Welcome -->
                <div x-show="currentStep === 1" class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-nss-green-500 to-nss-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Welcome to Daily~Track!</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">Your comprehensive activity tracking system . Let's take a quick tour to get you started.</p>
                </div>

                <!-- Step 2: Authentication -->
                <div x-show="currentStep === 2" class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-nss-yellow-500 to-nss-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Secure Login & Registration</h2>
                    <p class="text-lg text-gray-600 mb-4 leading-relaxed">Create your account or sign in to access the dashboard. Your data is protected with enterprise-grade security.</p>
                    <div class="bg-nss-green-50 border border-nss-green-200 rounded-xl p-4 text-left">
                        <p class="text-sm text-gray-700"><span class="font-semibold">💡 Tip:</span> Click the "Get Started" button in the top right to create your account in seconds.</p>
                    </div>
                </div>

                <!-- Step 3: Activity Management -->
                <div x-show="currentStep === 3" class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-nss-green-500 to-nss-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Create & Manage Activities</h2>
                    <p class="text-lg text-gray-600 mb-4 leading-relaxed">Easily add new activities with titles, descriptions, and track their progress with real-time status updates.</p>
                    <ul class="text-left space-y-2 text-gray-700">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-nss-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Add activities with detailed descriptions</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-nss-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Update status: Pending or Done</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-nss-green-600 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Add remarks and track who's working on what</span>
                        </li>
                    </ul>
                </div>

                <!-- Step 4: Daily View & Reports -->
                <div x-show="currentStep === 4" class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-nss-yellow-500 to-nss-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Daily View & Reports</h2>
                    <p class="text-lg text-gray-600 mb-4 leading-relaxed">View activities by date and generate comprehensive reports with custom filters.</p>
                    <div class="grid grid-cols-2 gap-4 text-left">
                        <div class="bg-nss-green-50 border border-nss-green-200 rounded-xl p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">📅 Daily View</h3>
                            <p class="text-sm text-gray-600">See all activities updated on any specific date with summary statistics.</p>
                        </div>
                        <div class="bg-nss-yellow-50 border border-nss-yellow-200 rounded-xl p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">📊 Reports</h3>
                            <p class="text-sm text-gray-600">Filter by date range, status, and personnel to generate detailed reports.</p>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Ready to Start -->
                <div x-show="currentStep === 5" class="text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-nss-green-500 to-nss-green-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">You're All Set!</h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">You're ready to start tracking activities efficiently. Click below to create your account and boost your productivity.</p>
                    <div class="bg-gradient-to-r from-nss-green-50 to-nss-yellow-50 border border-nss-green-200 rounded-xl p-6">
                        <p class="text-gray-800 font-medium mb-4">🎉 Start managing your activities today!</p>
                        @guest
                            <a href="{{ route('register') }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-nss-green-600 to-nss-green-700 rounded-xl font-bold text-white hover:from-nss-green-700 hover:to-nss-green-800 transition-all shadow-lg">
                                Create Free Account
                                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        @endguest
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
                    <button @click="prevStep()"
                            x-show="currentStep > 1"
                            class="px-6 py-3 border-2 border-gray-300 rounded-xl font-semibold text-gray-700 hover:bg-gray-50 transition-all">
                        Previous
                    </button>
                    <div x-show="currentStep === 1"></div>

                    <button @click="nextStep()"
                            x-show="currentStep < totalSteps"
                            class="px-8 py-3 bg-gradient-to-r from-nss-green-600 to-nss-green-700 rounded-xl font-bold text-white hover:from-nss-green-700 hover:to-nss-green-800 transition-all shadow-lg">
                        Next
                    </button>

                    <button @click="completeOnboarding()"
                            x-show="currentStep === totalSteps"
                            class="px-8 py-3 bg-gradient-to-r from-nss-green-600 to-nss-green-700 rounded-xl font-bold text-white hover:from-nss-green-700 hover:to-nss-green-800 transition-all shadow-lg">
                        Get Started
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="fixed w-full bg-gray-900/95 backdrop-blur-md shadow-lg z-50 border-b border-nss-green-500/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-nss-green-500 to-nss-green-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-bold text-white">Daily<span class="text-nss-green-400">~</span>Track</span>
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-gradient-to-r from-nss-green-500 to-nss-green-600 rounded-xl font-semibold text-base text-white hover:from-nss-green-600 hover:to-nss-green-700 transition-all shadow-lg hover:shadow-xl">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-3 text-white hover:text-nss-green-400 font-medium transition-all">
                                Sign In
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-8 py-3 bg-gradient-to-r from-nss-green-500 to-nss-green-600 rounded-xl font-semibold text-base text-white hover:from-nss-green-600 hover:to-nss-green-700 transition-all shadow-lg hover:shadow-xl">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 overflow-hidden pt-20">
        <!-- Animated Background Bubbles -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-nss-green-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-nss-yellow-500/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-nss-green-400/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32">
            <div class="text-center">
                <h1 class="text-4xl sm:text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    Track Your Activities
                    <span class="block mt-3 bg-gradient-to-r from-nss-green-400 via-nss-green-500 to-nss-yellow-500 bg-clip-text text-transparent">
                        Streamline Your Workflow
                    </span>
                </h1>
                <p class="text-xl sm:text-2xl text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed">
                    A comprehensive activity tracking system designed for NSS personnel to efficiently manage tasks, monitor progress, and generate insightful reports.
                </p>
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="group px-10 py-5 bg-gradient-to-r from-nss-green-500 to-nss-green-600 rounded-2xl font-bold text-lg text-white hover:from-nss-green-600 hover:to-nss-green-700 transition-all shadow-2xl hover:shadow-nss-green-500/50 flex items-center justify-center transform hover:scale-105">
                                Open Dashboard
                                <svg class="ml-3 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="group px-10 py-5 bg-gradient-to-r from-nss-green-500 to-nss-green-600 rounded-2xl font-bold text-lg text-white hover:from-nss-green-600 hover:to-nss-green-700 transition-all shadow-2xl hover:shadow-nss-green-500/50 flex items-center justify-center transform hover:scale-105">
                                Start Tracking Now
                                <svg class="ml-3 w-6 h-6 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </a>
                            <a href="{{ route('login') }}" class="px-10 py-5 border-2 border-nss-green-500 rounded-2xl font-semibold text-lg text-white hover:bg-nss-green-500/10 transition-all backdrop-blur-sm">
                                Sign In
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="relative">
            <svg class="w-full h-16 text-gray-50" preserveAspectRatio="none" viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg">
                <path fill="currentColor" d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25"></path>
                <path fill="currentColor" d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5"></path>
                <path fill="currentColor" d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"></path>
            </svg>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-gradient-to-br from-gray-50 via-white to-nss-green-50 py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 animate-fade-in">
                <h2 class="text-5xl font-bold text-gray-900 mb-6 bg-gradient-to-r from-nss-green-600 to-nss-yellow-600 bg-clip-text text-transparent">Powerful Features</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Everything you need to manage and track activities efficiently with cutting-edge tools</p>
            </div>

            <!-- First Row - 2 Cards Centered -->
            <div class="flex flex-wrap justify-center gap-8 mb-8 max-w-5xl mx-auto">
                <!-- Feature Card 1 -->
                <div class="group relative w-full md:w-[calc(50%-1rem)] bg-white/90 backdrop-blur-sm p-10 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 border-2 border-nss-green-100 hover:border-nss-green-300 transform hover:-translate-y-3 hover:scale-105 overflow-hidden animate-slide-up" style="animation-delay: 0.1s;">
                    <!-- Animated gradient background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-nss-green-50/50 via-transparent to-nss-yellow-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <!-- Floating particles effect -->
                    <div class="absolute top-4 right-4 w-20 h-20 bg-nss-yellow-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="absolute bottom-4 left-4 w-16 h-16 bg-nss-green-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 delay-100"></div>
                    
                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-nss-green-500 via-nss-green-600 to-nss-green-700 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-2xl group-hover:shadow-nss-green-500/50">
                            <svg class="w-10 h-10 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4 group-hover:text-nss-green-600 transition-colors duration-300">Activity Management</h3>
                        <p class="text-gray-600 leading-relaxed text-lg">Create, edit, and organize activities with detailed descriptions, assignees, and priority levels for better workflow management.</p>
                    </div>
                    
                    <!-- Animated corner accent -->
                    <div class="absolute -top-2 -right-2 w-24 h-24 bg-gradient-to-br from-nss-green-400 to-nss-yellow-400 opacity-0 group-hover:opacity-20 rounded-full blur-xl transition-all duration-500 group-hover:scale-150"></div>
                </div>

                <!-- Feature Card 2 -->
                <div class="group relative w-full md:w-[calc(50%-1rem)] bg-white/90 backdrop-blur-sm p-10 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 border-2 border-nss-yellow-100 hover:border-nss-yellow-300 transform hover:-translate-y-3 hover:scale-105 overflow-hidden animate-slide-up" style="animation-delay: 0.2s;">
                    <!-- Animated gradient background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-nss-yellow-50/50 via-transparent to-nss-green-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <!-- Floating particles effect -->
                    <div class="absolute top-4 right-4 w-20 h-20 bg-nss-green-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="absolute bottom-4 left-4 w-16 h-16 bg-nss-yellow-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700 delay-100"></div>
                    
                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-nss-yellow-500 via-nss-yellow-600 to-nss-yellow-700 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-2xl group-hover:shadow-nss-yellow-500/50">
                            <svg class="w-10 h-10 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4 group-hover:text-nss-yellow-600 transition-colors duration-300">Real-Time Updates</h3>
                        <p class="text-gray-600 leading-relaxed text-lg">Track progress instantly with status updates, remarks, and timestamps to keep everyone informed and aligned.</p>
                    </div>
                    
                    <!-- Animated corner accent -->
                    <div class="absolute -top-2 -right-2 w-24 h-24 bg-gradient-to-br from-nss-yellow-400 to-nss-green-400 opacity-0 group-hover:opacity-20 rounded-full blur-xl transition-all duration-500 group-hover:scale-150"></div>
                </div>
            </div>

            <!-- Second Row - 3 Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                <!-- Feature Card 3 -->
                <div class="group relative bg-white/90 backdrop-blur-sm p-10 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 border-2 border-nss-green-100 hover:border-nss-green-300 transform hover:-translate-y-3 hover:scale-105 overflow-hidden animate-slide-up" style="animation-delay: 0.3s;">
                    <div class="absolute inset-0 bg-gradient-to-br from-nss-green-50/50 via-transparent to-nss-yellow-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="absolute top-4 right-4 w-16 h-16 bg-nss-yellow-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    
                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-nss-green-500 via-nss-green-600 to-nss-yellow-500 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-2xl group-hover:shadow-nss-green-500/50">
                            <svg class="w-10 h-10 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4 group-hover:text-nss-green-600 transition-colors duration-300">Daily Activity View</h3>
                        <p class="text-gray-600 leading-relaxed text-lg">Get a comprehensive overview of all activities updated on any specific day with summary statistics.</p>
                    </div>
                    
                    <div class="absolute -bottom-2 -left-2 w-24 h-24 bg-gradient-to-br from-nss-green-400 to-nss-yellow-400 opacity-0 group-hover:opacity-20 rounded-full blur-xl transition-all duration-500 group-hover:scale-150"></div>
                </div>

                <!-- Feature Card 4 -->
                <div class="group relative bg-white/90 backdrop-blur-sm p-10 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 border-2 border-nss-yellow-100 hover:border-nss-yellow-300 transform hover:-translate-y-3 hover:scale-105 overflow-hidden animate-slide-up" style="animation-delay: 0.4s;">
                    <div class="absolute inset-0 bg-gradient-to-br from-nss-yellow-50/50 via-transparent to-nss-green-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="absolute top-4 right-4 w-16 h-16 bg-nss-green-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    
                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-nss-yellow-500 via-nss-yellow-600 to-nss-green-500 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-2xl group-hover:shadow-nss-yellow-500/50">
                            <svg class="w-10 h-10 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4 group-hover:text-nss-yellow-600 transition-colors duration-300">Reporting</h3>
                        <p class="text-gray-600 leading-relaxed text-lg">Generate detailed reports with custom date ranges, status filters, and comprehensive activity breakdowns.</p>
                    </div>
                    
                    <div class="absolute -bottom-2 -right-2 w-24 h-24 bg-gradient-to-br from-nss-yellow-400 to-nss-green-400 opacity-0 group-hover:opacity-20 rounded-full blur-xl transition-all duration-500 group-hover:scale-150"></div>
                </div>

                <!-- Feature Card 5 -->
                <div class="group relative bg-white/90 backdrop-blur-sm p-10 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 border-2 border-nss-green-100 hover:border-nss-green-300 transform hover:-translate-y-3 hover:scale-105 overflow-hidden animate-slide-up md:col-span-2 lg:col-span-1 md:mx-auto md:max-w-md lg:max-w-none" style="animation-delay: 0.5s;">
                    <div class="absolute inset-0 bg-gradient-to-br from-nss-green-50/50 via-transparent to-nss-yellow-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    
                    <div class="absolute top-4 right-4 w-16 h-16 bg-nss-yellow-400/20 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                    
                    <div class="relative z-10">
                        <div class="w-20 h-20 bg-gradient-to-br from-nss-green-500 via-nss-yellow-500 to-nss-green-600 rounded-3xl flex items-center justify-center mb-8 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-2xl group-hover:shadow-nss-green-500/50">
                            <svg class="w-10 h-10 text-white group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4 group-hover:text-nss-green-600 transition-colors duration-300">Secure & Reliable</h3>
                        <p class="text-gray-600 leading-relaxed text-lg">Enterprise-grade security with role-based access control and encrypted data protection.</p>
                    </div>
                    
                    <div class="absolute -bottom-2 -right-2 w-24 h-24 bg-gradient-to-br from-nss-green-400 to-nss-yellow-400 opacity-0 group-hover:opacity-20 rounded-full blur-xl transition-all duration-500 group-hover:scale-150"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-slide-up {
            animation: slide-up 0.8s ease-out forwards;
            opacity: 0;
        }
        
        .animate-fade-in {
            animation: fade-in 1s ease-out;
        }
    </style>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 py-20 relative overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-nss-green-500/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-nss-yellow-500/10 rounded-full blur-3xl"></div>
        </div>
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl sm:text-5xl font-bold text-white mb-6">Ready to Get Started?</h2>
            <p class="text-xl text-gray-300 mb-10 leading-relaxed">Join NSS personnel in streamlining activity tracking and boost your productivity today.</p>
            @if (Route::has('login'))
                @guest
                    <a href="{{ route('register') }}" class="inline-flex items-center px-10 py-5 bg-gradient-to-r from-nss-green-500 to-nss-green-600 rounded-2xl font-bold text-lg text-white hover:from-nss-green-600 hover:to-nss-green-700 transition-all shadow-2xl hover:shadow-nss-green-500/50 transform hover:scale-105">
                        Create Free Account
                        <svg class="ml-3 w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                @endguest
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white/80 backdrop-blur-sm border-t border-nss-green-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center">
                <div class="flex justify-center items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-nss-green-500 to-nss-green-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">Daily<span class="text-nss-green-600">~</span>Track</span>
                </div>
                <p class="text-gray-600">&copy; {{ date('Y') }} Daily~Track - NSS Activity Tracking System. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
