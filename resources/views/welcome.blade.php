<!DOCTYPE html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="نظام العالمية لإدارة المشاريع - تبسيط سير عمل مشروعك">

        <title>العالمية لإدارة المشاريع - {{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|plus-jakarta-sans:400,500,600,700|noto-sans-arabic:400,500,600,700" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <script src="{{ asset('js/app.js') }}" defer></script>
        @endif
    </head>
    <body class="bg-gradient-to-b from-blue-50 to-white dark:from-[#0a0a0a] dark:to-[#111111] text-[#1b1b18] min-h-screen flex flex-col font-['Noto_Sans_Arabic']">
        <header class="w-full border-b border-blue-100/30 dark:border-blue-800/20 backdrop-blur-sm bg-white/60 dark:bg-black/60 fixed top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center space-x-reverse space-x-8">
                        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-400 dark:to-blue-200 text-transparent bg-clip-text">العالمية لإدارة المشاريع</span>
                        <nav class="hidden md:flex items-center space-x-reverse space-x-6">
                            <a href="#features" class="text-blue-700 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-200 text-sm font-medium">المميزات</a>
                            <a href="#about" class="text-blue-700 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-200 text-sm font-medium">حول</a>
                            <a href="#contact" class="text-blue-700 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-200 text-sm font-medium">اتصل بنا</a>
                        </nav>
                    </div>

                    <div class="flex items-center space-x-4">
                        <!-- Language Switcher -->
                        <div class="relative">
                            <button type="button" class="inline-flex items-center px-3 py-1.5 text-sm text-blue-700 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-200 focus:outline-none">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                                </svg>
                                {{ strtoupper(app()->getLocale()) }}
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 hidden">
                                <div class="py-1">
                                    <a href="#" class="block px-4 py-2 text-sm text-blue-700 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/30">English</a>
                                    <a href="#" class="block px-4 py-2 text-sm text-blue-700 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/30">العربية</a>
                                </div>
                            </div>
                        </div>

                        @if (Route::has('login'))
                            <nav class="flex items-center space-x-4">
                                @auth
                                    <div class="relative group">
                                        <button type="button" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white dark:bg-blue-500 rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors duration-200">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                            الحساب
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </button>
                                        <div class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 hidden group-hover:block">
                                            <div class="py-1">
                                                <a href="{{ route('filament.admin.pages.dashboard') }}" class="block px-4 py-2 text-sm text-blue-700 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 text-right">
                                                    لوحة التحكم
                                                </a>
                                                <a href="#" class="block px-4 py-2 text-sm text-blue-700 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/30 text-right">
                                                    الملف الشخصي
                                                </a>
                                                <div class="border-t border-gray-100 dark:border-gray-700"></div>
                                                <form method="POST" action="{{ route('logout') }}">
                                                    @csrf
                                                    <button type="submit" class="block w-full text-right px-4 py-2 text-sm text-blue-700 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-900/30">
                                                        تسجيل الخروج
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('filament.admin.auth.login') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium">
                                        تسجيل الدخول
                                    </a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('filament.admin.auth.register') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white dark:bg-blue-500 rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors duration-200 text-sm font-medium">
                                            ابدأ الآن
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                </div>
            </div>
        </header>

        <div class="pt-24 pb-12 px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="max-w-7xl mx-auto w-full">
                <div class="text-center mb-16">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 dark:from-blue-300 dark:via-blue-400 dark:to-blue-300 text-transparent bg-clip-text mb-6">
                        قم بتبسيط مشاريعك<br>مع نظام العالمية لإدارة المشاريع
                    </h1>
                    <p class="max-w-2xl mx-auto text-lg text-blue-700/70 dark:text-blue-200/80">
                        أداة خفيفة وبديهية مصممة لمساعدة الفرق على تخطيط وتتبع وتسليم المشاريع بشكل أسرع. مبنية لتكون بسيطة وقوية في نفس الوقت، تساعدك العالمية على التركيز على العمل المهم.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
                    <div class="bg-white/90 dark:bg-[#161615] rounded-xl shadow-lg shadow-blue-100 dark:shadow-2xl dark:shadow-blue-900/10 p-8 transform transition-transform hover:scale-[1.02]">
                        <div class="bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-400 dark:to-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white dark:text-[#1b1b18]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold mb-4 dark:text-white">المميزات الرئيسية</h2>
                        <ul class="space-y-3 text-[#706f6c] dark:text-[#A1A09A]">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 ml-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                إنشاء وتنظيم المشاريع
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 ml-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                إدارة المهام مع تتبع الحالة
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 ml-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                سجلات النشاط والتعليقات
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 ml-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                إرفاق الملفات للمهام
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 ml-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                أدوار وصلاحيات المستخدمين
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white dark:bg-[#161615] rounded-xl shadow-lg dark:shadow-2xl dark:shadow-[#111]/20 p-8 transform transition-transform hover:scale-[1.02]">
                        <div class="bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-400 dark:to-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold mb-4 dark:text-white">كيفية البدء</h2>
                        <ol class="space-y-4 text-[#706f6c] dark:text-[#A1A09A] text-right">
                            <li class="flex flex-row-reverse">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-[#1b1b18]/10 dark:bg-white/10 flex items-center justify-center ml-3 mt-0.5">١</span>
                                <span>أنشئ حسابًا أو سجل دخول باستخدام الروابط في الأعلى</span>
                            </li>
                            <li class="flex flex-row-reverse">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-[#1b1b18]/10 dark:bg-white/10 flex items-center justify-center ml-3 mt-0.5">٢</span>
                                <span>أنشئ مشروعًا جديدًا وادعُ أعضاء الفريق</span>
                            </li>
                            <li class="flex flex-row-reverse">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-[#1b1b18]/10 dark:bg-white/10 flex items-center justify-center ml-3 mt-0.5">٣</span>
                                <span>أضف المهام وحدد حالتها وعيّن أعضاء الفريق</span>
                            </li>
                            <li class="flex flex-row-reverse">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full bg-[#1b1b18]/10 dark:bg-white/10 flex items-center justify-center ml-3 mt-0.5">٤</span>
                                <span>تتبع التقدم باستخدام سجلات النشاط والتعليقات</span>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                    <div class="bg-gradient-to-b from-white to-blue-50/80 dark:bg-[#161615]/50 backdrop-blur-sm rounded-xl p-8 border border-blue-100 dark:border-blue-800/30 hover:border-blue-200 dark:hover:border-blue-700/40 transition-colors duration-300">
                        <div class="text-center">
                            <svg class="w-8 h-8 mx-auto mb-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            <h3 class="text-lg font-semibold mb-2 text-blue-900 dark:text-blue-300">سريع كالبرق</h3>
                            <p class="text-blue-600/70 dark:text-blue-200/70">مبني للسرعة والكفاءة، لمساعدة فريقك على العمل بشكل أسرع</p>
                        </div>
                    </div>
                    <div class="bg-white/50 dark:bg-[#161615]/50 backdrop-blur-sm rounded-xl p-8 border border-gray-200/50 dark:border-gray-800/50">
                        <div class="text-center">
                            <svg class="w-8 h-8 mx-auto mb-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            <h3 class="text-lg font-semibold mb-2 text-blue-900 dark:text-blue-300">يركز على الفريق</h3>
                            <p class="text-blue-600/70 dark:text-blue-200/70">مصمم للتعاون السلس وتنسيق الفريق</p>
                        </div>
                    </div>
                    <div class="bg-white/50 dark:bg-[#161615]/50 backdrop-blur-sm rounded-xl p-8 border border-gray-200/50 dark:border-gray-800/50">
                        <div class="text-center">
                            <svg class="w-8 h-8 mx-auto mb-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <h3 class="text-lg font-semibold mb-2 text-blue-900 dark:text-blue-300">آمن وموثوق</h3>
                            <p class="text-blue-600/70 dark:text-blue-200/70">أمان على مستوى المؤسسات مع ضمان توفر 99.9٪</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-blue-800 dark:from-blue-400 dark:to-blue-600 rounded-2xl p-12 text-center mb-16 shadow-lg shadow-blue-200 dark:shadow-blue-900/20">
                    <h2 class="text-3xl font-bold text-white dark:text-white mb-6">هل أنت مستعد لتبسيط سير عملك؟</h2>
                    <p class="text-blue-100 dark:text-blue-100 mb-8 max-w-2xl mx-auto">انضم إلى آلاف الفرق التي تستخدم نظام العالمية لإدارة مشاريعها بكفاءة أعلى.</p>
                    @auth
                        <a href="{{ route('filament.admin.pages.dashboard') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-700 dark:bg-blue-900 dark:text-white rounded-lg hover:bg-blue-50 dark:hover:bg-blue-800 transition-colors duration-200">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            فتح لوحة التحكم
                        </a>
                    @else
                        <div class="flex gap-4 justify-center">
                            <a href="{{ route('filament.admin.auth.login') }}" class="inline-flex items-center px-6 py-3 bg-white dark:bg-[#1b1b18] text-[#1b1b18] dark:text-white rounded-lg hover:bg-gray-100 dark:hover:bg-[#2a2a26] transition-colors duration-200">
                                تسجيل الدخول
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('filament.admin.auth.register') }}" class="inline-flex items-center px-6 py-3 bg-transparent border-2 border-white dark:border-[#1b1b18] text-white dark:text-[#1b1b18] rounded-lg hover:bg-white/10 dark:hover:bg-[#1b1b18]/10 transition-colors duration-200">
                                    ابدأ الآن
                                </a>
                            @endif
                        </div>
                    @endauth
                </div>

                <footer class="border-t border-gray-200/10 dark:border-gray-800/50 pt-8 text-center text-sm text-[#706f6c] dark:text-[#A1A09A]">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                        <div>
                            <h4 class="font-semibold text-[#1b1b18] dark:text-white mb-4">اتصل بنا</h4>
                            <p><a href="mailto:support@alalamia.example" class="hover:text-[#1b1b18] dark:hover:text-white transition-colors">support@alalamia.example</a></p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#1b1b18] dark:text-white mb-4">المصادر</h4>
                            <ul class="space-y-2">
                                <li><a href="https://example.com/docs" class="hover:text-[#1b1b18] dark:hover:text-white transition-colors">التوثيق</a></li>
                                <li><a href="https://example.com/support" class="hover:text-[#1b1b18] dark:hover:text-white transition-colors">الدعم</a></li>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-semibold text-[#1b1b18] dark:text-white mb-4">للمطورين</h4>
                            <p>مبني باستخدام Laravel و Filament.<br>راجع <code class="bg-[#1b1b18]/5 dark:bg-white/5 px-1.5 py-0.5 rounded">app/</code> للتخصيص.</p>
                        </div>
                    </div>
                    <div class="mt-8 pt-8 border-t border-gray-200/10 dark:border-gray-800/50">
                        <p>&copy; {{ date('Y') }} العالمية لإدارة المشاريع. جميع الحقوق محفوظة.</p>
                    </div>
                </footer>
            </main>
        </div>
    </body>
</html>

