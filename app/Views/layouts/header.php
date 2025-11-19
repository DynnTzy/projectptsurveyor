<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title><?= esc($title ?? 'EMS') ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }

        .card-shadow {
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        }

        /* subtle divider in sidebar */
        .sidebar-divider {
            height: 1px;
            background: rgba(0, 0, 0, 0.04);
            margin: 12px 0;
        }

        /* avatar sizes */
        .avatar-initial {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 9999px;
            color: #fff;
            font-weight: 600;
        }

        /* smooth slide for sidebar */
        .sidebar-slide {
            transition: transform .22s cubic-bezier(.2, .9, .3, 1), opacity .18s ease;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

    <!-- Topbar -->
    <header class="bg-gradient-to-r from-purple-600 via-pink-600 to-indigo-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">

            <!-- Left: hamburger + brand -->
            <div class="flex items-center gap-4">
                <!-- mobile toggle -->
                <button id="sidebarToggle" class="sm:hidden p-2 rounded-md hover:bg-white/10 focus:outline-none" aria-label="Toggle sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <div class="flex items-center gap-3">
                    <div class="px-3 py-1 rounded-md bg-white/10 font-semibold text-sm tracking-wide">SISTEM MANAJEMEN PEGAWAI</div>
                </div>
            </div>

            <!-- Right: optional controls + profile -->
            <div class="flex items-center gap-4">

                <div class="flex items-center gap-3">
                    <div class="text-sm hidden sm:block text-white/90">Administrator</div>

                    <!-- Profile dropdown -->
                    <div class="relative">
                        <button id="profileBtn" class="flex items-center gap-2 px-2 py-1 rounded-md hover:bg-white/10 focus:outline-none" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar-initial" style="background: #7C3AED">
                                <?= strtoupper(substr(session()->get('username') ?? 'A', 0, 1)) ?>
                            </div>
                        </button>

                        <div id="profileMenu" class="hidden absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg text-sm overflow-hidden">
                            <a href="/logout" class="block px-4 py-2 hover:bg-gray-50">Logout</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </header>

    <div class="flex">

        <!-- Sidebar (desktop) -->
        <aside id="sidebar" class="w-64 bg-white border-r sidebar-slide hidden sm:block">
            <div class="px-4 py-6 sidebar-scroll h-[calc(100vh-64px)] overflow-auto">

                <!-- card-like wrapper -->
                <div class="card-shadow bg-white rounded-xl p-4">

                    <!-- main menu -->
                    <nav>

                        <!-- Data Pegawai -->
                        <a href="/employees"
                            class="flex items-center gap-3 px-3 py-2 rounded-md <?= url_is('employees') || url_is('employees/*') ? 'bg-gray-100 shadow-sm' : 'hover:bg-gray-50' ?>">
                            <svg class="h-5 w-5 text-sky-600" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9 9 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-medium text-slate-700">Data Pegawai</span>
                        </a>

                        <a href="/employees/create"
                            class="flex items-center gap-3 px-3 py-2 mt-2 rounded-md <?= url_is('employees/create') ? 'bg-gray-100 shadow-sm' : 'hover:bg-gray-50' ?>">
                            <svg class="h-5 w-5 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="text-slate-600">Tambah Pegawai</span>
                        </a>

                        <div class="sidebar-divider"></div>

                        <!-- Collapsible Data Master -->
                        <?php $masterActive = url_is('master/*') || url_is('master/cabang*') || url_is('master/divisi*') || url_is('master/bagian*'); ?>
                        <button id="masterToggleSidebar" class="w-full flex items-center justify-between px-3 py-2 rounded-md hover:bg-gray-50 focus:outline-none" aria-controls="masterMenuSidebar" aria-expanded="<?= $masterActive ? 'true' : 'false' ?>">
                            <div class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
                                </svg>
                                <span class="uppercase text-xs text-gray-500 font-semibold">Data Master</span>
                            </div>
                            <svg id="masterChevronSidebar" class="h-4 w-4 text-gray-400 transform <?= $masterActive ? 'rotate-90' : '' ?>" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4l8 6-8 6" />
                            </svg>
                        </button>

                        <div id="masterMenuSidebar" class="mt-2 pl-6 space-y-1 <?= $masterActive ? '' : 'hidden' ?>">
                            <a href="/master/cabang" class="block py-2 rounded-md px-2 <?= url_is('master/cabang') || url_is('master/cabang/*') ? 'text-sky-600 font-semibold bg-gray-50' : 'hover:bg-gray-50 text-slate-700' ?>">Master Cabang</a>
                            <a href="/master/divisi" class="block py-2 rounded-md px-2 <?= url_is('master/divisi') || url_is('master/divisi/*') ? 'text-sky-600 font-semibold bg-gray-50' : 'hover:bg-gray-50 text-slate-700' ?>">Master Divisi</a>
                            <a href="/master/bagian" class="block py-2 rounded-md px-2 <?= url_is('master/bagian') || url_is('master/bagian/*') ? 'text-sky-600 font-semibold bg-gray-50' : 'hover:bg-gray-50 text-slate-700' ?>">Master Bagian</a>
                        </div>

                    </nav>

                </div>

            </div>
        </aside>

        <!-- Mobile sidebar (slide-in) -->
        <div id="mobileSidebar" class="fixed inset-0 z-40 hidden">
            <div id="mobileBackdrop" class="absolute inset-0 bg-black/30"></div>
            <aside class="absolute left-0 top-0 bottom-0 w-64 bg-white card-shadow p-4 overflow-auto">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-sm font-semibold">Menu</div>
                    <button id="mobileClose" class="p-1 rounded-md hover:bg-gray-100">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <nav class="space-y-2">
                    <a href="/employees" class="block py-2 px-2 rounded-md hover:bg-gray-50">Data Pegawai</a>
                    <a href="/employees/create" class="block py-2 px-2 rounded-md hover:bg-gray-50">Tambah Pegawai</a>
                    <div class="sidebar-divider"></div>
                    <div class="text-xs uppercase text-gray-500 font-semibold">Data Master</div>
                    <a href="/master/cabang" class="block py-2 px-2 rounded-md hover:bg-gray-50 pl-4">Master Cabang</a>
                    <a href="/master/divisi" class="block py-2 px-2 rounded-md hover:bg-gray-50 pl-4">Master Divisi</a>
                    <a href="/master/bagian" class="block py-2 px-2 rounded-md hover:bg-gray-50 pl-4">Master Bagian</a>
                </nav>
            </aside>
        </div>

        <!-- Main content -->
        <div id="contentArea" class="flex-1 p-6">
            <div class="max-w-7xl mx-auto">

                <!-- end header.php; rest of page will be inserted after this file -->