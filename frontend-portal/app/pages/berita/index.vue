<template>
  <div class="min-h-screen bg-[#f8f7fc] text-slate-800 relative overflow-hidden font-sans selection:bg-pink-500 selection:text-white pb-24">
    <!-- Background Mesh Gradient & Glowing Ambient Orbs -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
      <!-- Top Left Pink Orb -->
      <div class="absolute -top-32 -left-32 w-96 sm:w-[32rem] h-96 sm:h-[32rem] bg-gradient-to-br from-pink-300/40 via-pink-400/25 to-transparent rounded-full blur-3xl animate-pulse" style="animation-duration: 8s;"></div>
      <!-- Top Right Purple Orb -->
      <div class="absolute -top-24 right-[-10%] w-[32rem] sm:w-[42rem] h-[32rem] sm:h-[42rem] bg-gradient-to-bl from-purple-400/35 via-fuchsia-300/25 to-transparent rounded-full blur-3xl"></div>
      <!-- Center Ambient Glow -->
      <div class="absolute top-1/3 left-1/2 -translate-x-1/2 w-[38rem] h-[38rem] bg-gradient-to-tr from-indigo-200/30 via-purple-200/20 to-pink-200/20 rounded-full blur-3xl"></div>
      <!-- Bottom Left Violet Glow -->
      <div class="absolute -bottom-32 left-[-5%] w-96 h-96 bg-purple-300/25 rounded-full blur-3xl"></div>
      <!-- Bottom Right Rose Glow -->
      <div class="absolute -bottom-24 right-10 w-96 h-96 bg-pink-200/30 rounded-full blur-3xl"></div>
    </div>

    <!-- Main Content Container -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 sm:pt-14 space-y-12">
      
      <!-- Top Hero / Navigation Bar -->
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-purple-100/80">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-pink-500 via-rose-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-pink-500/25">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
          </div>
          <div>
            <h2 class="text-lg font-bold bg-gradient-to-r from-slate-900 to-slate-700 bg-clip-text text-transparent">Portal Berita</h2>
            <p class="text-xs text-slate-500 font-medium">Manajemen Konten & Artikel Wisata</p>
          </div>
        </div>

        <!-- Right Quick Actions / Navigation links -->
        <div class="flex items-center gap-2">
          <NuxtLink to="/layanan" class="px-4 py-2 rounded-2xl text-xs font-semibold text-purple-700 bg-purple-50 hover:bg-purple-100/80 border border-purple-200/60 transition-all flex items-center gap-1.5">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span>Portal Layanan</span>
          </NuxtLink>
          <a href="#tabel-berita" class="px-4 py-2 rounded-2xl text-xs font-semibold text-slate-600 bg-white/80 hover:bg-white border border-slate-200 shadow-sm transition-all flex items-center gap-1.5">
            <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            <span>Lihat Data ({{ beritas.length }})</span>
          </a>
        </div>
      </div>

      <!-- Hero Header Typography (Travel Booking Vibe) -->
      <div class="text-center max-w-3xl mx-auto space-y-4">
        <!-- Badge Pill -->
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-pink-50/90 border border-pink-200/80 text-pink-600 text-xs font-semibold tracking-wide shadow-sm shadow-pink-500/10">
          <span class="flex h-2 w-2 relative">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-pink-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-2 w-2 bg-pink-500"></span>
          </span>
          <span>Eksplorasi Wawasan & Informasi Terkini</span>
        </div>

        <!-- Big Gradient Title -->
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-800 leading-[1.15]">
          Where would you like to
          <span class="block mt-1 bg-gradient-to-r from-pink-500 via-rose-500 to-purple-600 bg-clip-text text-transparent drop-shadow-sm">
            Publish & Explore?
          </span>
        </h1>
        <p class="text-sm sm:text-base text-slate-500 leading-relaxed font-normal max-w-2xl mx-auto">
          Tuliskan berita memukau, kurasi cerita perjalanan terbaik, dan kelola seluruh publikasi dengan antarmuka modern yang memanjakan mata.
        </p>
      </div>

      <!-- Toast Feedback Message -->
      <transition enter-active-class="transform ease-out duration-300 transition" enter-from-class="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2" enter-to-class="translate-y-0 opacity-100 sm:translate-x-0" leave-active-class="transition ease-in duration-200" leave-from-class="opacity-100" leave-to-class="opacity-0">
        <div v-if="notification.show" :class="notification.type === 'success' ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white'" class="max-w-md mx-auto p-4 rounded-2xl shadow-xl flex items-center justify-between gap-3 text-sm font-medium">
          <div class="flex items-center gap-2">
            <svg v-if="notification.type === 'success'" class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <svg v-else class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ notification.message }}</span>
          </div>
          <button @click="notification.show = false" class="text-white/80 hover:text-white">✕</button>
        </div>
      </transition>

      <!-- Glassmorphism Floating Main Card: Form Input Berita -->
      <div ref="formCardRef" id="form-section" class="relative bg-white/85 backdrop-blur-2xl rounded-3xl sm:rounded-[2.5rem] p-6 sm:p-10 lg:p-12 shadow-2xl shadow-purple-900/5 border border-white/90 ring-1 ring-purple-100/60 transition-all duration-300">
        
        <!-- Mini Navigation Tabs inside Card (Travel Mode Tabs) -->
        <div class="flex flex-wrap items-center justify-between gap-4 pb-6 mb-8 border-b border-slate-100">
          <div class="inline-flex p-1.5 bg-slate-100/80 backdrop-blur-md rounded-2xl border border-slate-200/50 gap-1">
            <button 
              type="button" 
              class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all duration-200 flex items-center gap-2 shadow-sm bg-white text-purple-700 shadow-purple-500/10"
            >
              <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              <span>{{ isEdit ? 'Mode Edit Berita' : 'Form Input Berita' }}</span>
            </button>
            <a 
              href="#tabel-berita"
              class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-medium text-slate-500 hover:text-slate-800 transition-all duration-200 flex items-center gap-2"
            >
              <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
              </svg>
              <span>Semua Koleksi</span>
            </a>
          </div>

          <!-- Quick Category Preset Badges -->
          <div class="flex items-center flex-wrap gap-1.5">
            <span class="text-xs font-medium text-slate-400 mr-1 flex items-center gap-1">
              <svg class="w-3.5 h-3.5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
              </svg>
              Kategori Cepat:
            </span>
            <button
              v-for="cat in quickCategories"
              :key="cat"
              type="button"
              @click="form.kategori = cat"
              :class="form.kategori === cat 
                ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-sm shadow-pink-500/20' 
                : 'bg-slate-50 text-slate-600 hover:bg-purple-50 hover:text-purple-600 border border-slate-200/60'"
              class="px-3 py-1 rounded-full text-xs font-medium transition-all duration-150 active:scale-95"
            >
              {{ cat }}
            </button>
          </div>
        </div>

        <!-- Form Input Berita -->
        <form @submit.prevent="saveBerita" class="space-y-6">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <!-- Judul Berita -->
            <div class="md:col-span-2 group bg-slate-50/70 hover:bg-white focus-within:bg-white border border-slate-200/80 focus-within:border-purple-400 focus-within:ring-4 focus-within:ring-purple-100/70 rounded-2xl p-4 transition-all duration-200">
              <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
                Judul Berita <span class="text-rose-500">*</span>
              </label>
              <input 
                v-model="form.judul" 
                type="text" 
                placeholder="Contoh: Menikmati Pesona Labuan Bajo Saat Senja"
                class="w-full bg-transparent text-slate-800 text-sm font-semibold outline-none placeholder-slate-400" 
                required 
              />
            </div>

            <!-- Kategori -->
            <div class="group bg-slate-50/70 hover:bg-white focus-within:bg-white border border-slate-200/80 focus-within:border-purple-400 focus-within:ring-4 focus-within:ring-purple-100/70 rounded-2xl p-4 transition-all duration-200">
              <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
                Kategori <span class="text-rose-500">*</span>
              </label>
              <input 
                v-model="form.kategori" 
                type="text" 
                placeholder="Wisata, Kuliner, Budaya..."
                class="w-full bg-transparent text-slate-800 text-sm font-medium outline-none placeholder-slate-400" 
                required 
              />
            </div>

            <!-- Tanggal -->
            <div class="group bg-slate-50/70 hover:bg-white focus-within:bg-white border border-slate-200/80 focus-within:border-purple-400 focus-within:ring-4 focus-within:ring-purple-100/70 rounded-2xl p-4 transition-all duration-200">
              <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Tanggal Rilis <span class="text-rose-500">*</span>
              </label>
              <input 
                v-model="form.tanggal" 
                type="date" 
                class="w-full bg-transparent text-slate-800 text-sm font-medium outline-none text-slate-600" 
                required 
              />
            </div>

            <!-- Siapa Yang Buat / Penulis -->
            <div class="md:col-span-2 group bg-slate-50/70 hover:bg-white focus-within:bg-white border border-slate-200/80 focus-within:border-purple-400 focus-within:ring-4 focus-within:ring-purple-100/70 rounded-2xl p-4 transition-all duration-200">
              <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5 flex items-center gap-1.5">
                <svg class="w-4 h-4 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Siapa Yang Buat (Penulis) <span class="text-rose-500">*</span>
              </label>
              <input 
                v-model="form.siapa_yang_buat" 
                type="text" 
                placeholder="Contoh: Sarah Anderson, Redaksi Travel"
                class="w-full bg-transparent text-slate-800 text-sm font-medium outline-none placeholder-slate-400" 
                required 
              />
            </div>

            <!-- Gambar (URL) -->
            <div class="md:col-span-2 group bg-slate-50/70 hover:bg-white focus-within:bg-white border border-slate-200/80 focus-within:border-purple-400 focus-within:ring-4 focus-within:ring-purple-100/70 rounded-2xl p-4 transition-all duration-200">
              <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-1.5 flex items-center justify-between">
                <span class="flex items-center gap-1.5">
                  <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  Gambar Sampul (URL)
                </span>
                <span v-if="form.gambar" class="text-[10px] text-pink-600 font-semibold bg-pink-50 px-2 py-0.5 rounded-full">Preview Siap</span>
              </label>
              <div class="flex items-center gap-2">
                <input 
                  v-model="form.gambar" 
                  type="url" 
                  placeholder="https://images.unsplash.com/photo-..."
                  class="w-full bg-transparent text-slate-800 text-sm font-medium outline-none placeholder-slate-400" 
                />
                <button 
                  v-if="form.gambar" 
                  type="button" 
                  @click="form.gambar = ''" 
                  class="text-xs text-slate-400 hover:text-rose-500 p-1"
                  title="Hapus Link"
                >
                  ✕
                </button>
              </div>
            </div>

          </div>

          <!-- Live Image Preview Card if URL is provided -->
          <div v-if="form.gambar" class="p-4 rounded-2xl bg-purple-50/60 border border-purple-100 flex flex-col sm:flex-row items-center gap-4">
            <div class="w-full sm:w-36 h-24 rounded-xl overflow-hidden bg-slate-200 flex-shrink-0 shadow-sm border border-white">
              <img 
                :src="form.gambar" 
                alt="Preview Sampul" 
                class="w-full h-full object-cover"
                @error="imageLoadError = true" 
                @load="imageLoadError = false"
              />
            </div>
            <div class="text-xs text-slate-600 flex-1">
              <p class="font-semibold text-slate-800 mb-0.5">Pratinjau Gambar Sampul Berita</p>
              <p v-if="!imageLoadError" class="text-emerald-600 font-medium flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Gambar berhasil dimuat dengan baik.
              </p>
              <p v-else class="text-rose-500 font-medium">URL gambar tidak valid atau tidak dapat dimuat langsung.</p>
              <p class="text-slate-400 truncate max-w-md mt-1">{{ form.gambar }}</p>
            </div>
          </div>

          <!-- Isian Berita (Textarea) -->
          <div class="group bg-slate-50/70 hover:bg-white focus-within:bg-white border border-slate-200/80 focus-within:border-purple-400 focus-within:ring-4 focus-within:ring-purple-100/70 rounded-2xl p-4 transition-all duration-200">
            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wider mb-2 flex items-center gap-1.5">
              <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              Isian Lengkap Berita <span class="text-rose-500">*</span>
            </label>
            <textarea 
              v-model="form.isian" 
              rows="4" 
              placeholder="Ceritakan detail berita, ulasan destinasi, atau informasi penting di sini secara lengkap..."
              class="w-full bg-transparent text-slate-800 text-sm font-normal outline-none placeholder-slate-400 resize-y" 
              required
            ></textarea>
          </div>

          <!-- Form Action Buttons -->
          <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
            <div class="text-xs text-slate-400 hidden sm:block">
              <span class="text-rose-500 font-bold">*</span> Bidang wajib diisi sebelum publikasi.
            </div>

            <div class="flex items-center gap-3 w-full sm:w-auto">
              <!-- Batal Button (when editing) -->
              <button 
                v-if="isEdit" 
                @click="resetForm" 
                type="button" 
                class="flex-1 sm:flex-initial px-6 py-3.5 rounded-2xl text-slate-600 bg-slate-100 hover:bg-slate-200/80 font-semibold text-sm transition-all duration-200 flex items-center justify-center gap-2"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>Batal Edit</span>
              </button>

              <!-- Submit CTA Button (Gradient Travel Booking Vibe) -->
              <button 
                type="submit" 
                :disabled="isSubmitting"
                class="flex-1 sm:flex-initial px-8 py-3.5 rounded-2xl bg-gradient-to-r from-pink-500 via-rose-500 to-purple-600 hover:from-pink-600 hover:via-rose-600 hover:to-purple-700 text-white font-semibold text-sm shadow-xl shadow-pink-500/25 hover:shadow-2xl hover:shadow-purple-500/35 transition-all duration-200 active:scale-95 flex items-center justify-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed"
              >
                <svg v-if="isSubmitting" class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <svg v-else-if="isEdit" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
                <span>{{ isSubmitting ? 'Memproses...' : (isEdit ? 'Update Berita Sekarang' : 'Publikasikan Berita') }}</span>
              </button>
            </div>
          </div>
        </form>

      </div>

      <!-- Data Berita Section: Modern Card List & Table Hybrid -->
      <div id="tabel-berita" class="space-y-6">
        
        <!-- Section Controls & Filter Bar -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
          <div>
            <div class="flex items-center gap-2.5">
              <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Katalog Berita & Artikel</h2>
              <span class="px-3 py-1 rounded-full text-xs font-bold bg-pink-100 text-pink-700 border border-pink-200">
                {{ filteredBeritas.length }} Terdaftar
              </span>
            </div>
            <p class="text-xs text-slate-500 mt-1">Daftar publikasi berita dan cerita yang siap diakses pengguna</p>
          </div>

          <!-- Search & Filter Controls -->
          <div class="flex flex-wrap items-center gap-3">
            <!-- Search Bar -->
            <div class="relative w-full sm:w-64">
              <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </span>
              <input 
                v-model="searchQuery" 
                type="text" 
                placeholder="Cari judul, kategori, penulis..." 
                class="w-full pl-9 pr-4 py-2.5 rounded-2xl bg-white/90 border border-slate-200 text-xs font-medium text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-purple-400 shadow-sm"
              />
            </div>

            <!-- View Switcher (Table vs Grid) -->
            <div class="inline-flex p-1 bg-white/80 border border-slate-200/80 rounded-2xl shadow-sm">
              <button 
                @click="viewMode = 'table'" 
                :class="viewMode === 'table' ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-sm' : 'text-slate-500 hover:text-slate-800'"
                class="p-2 rounded-xl transition-all"
                title="Tampilan Tabel"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
              </button>
              <button 
                @click="viewMode = 'grid'" 
                :class="viewMode === 'grid' ? 'bg-gradient-to-r from-pink-500 to-purple-600 text-white shadow-sm' : 'text-slate-500 hover:text-slate-800'"
                class="p-2 rounded-xl transition-all"
                title="Tampilan Kartu (Grid)"
              >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Filter Category Tabs -->
        <div class="flex items-center gap-2 overflow-x-auto pb-1 no-scrollbar">
          <button 
            @click="selectedCategory = 'Semua'" 
            :class="selectedCategory === 'Semua' ? 'bg-purple-600 text-white shadow-md shadow-purple-500/20' : 'bg-white/70 text-slate-600 hover:bg-white border border-slate-200/60'"
            class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-all"
          >
            Semua ({{ beritas.length }})
          </button>
          <button 
            v-for="cat in availableCategories" 
            :key="cat" 
            @click="selectedCategory = cat"
            :class="selectedCategory === cat ? 'bg-purple-600 text-white shadow-md shadow-purple-500/20' : 'bg-white/70 text-slate-600 hover:bg-white border border-slate-200/60'"
            class="px-4 py-1.5 rounded-full text-xs font-semibold whitespace-nowrap transition-all"
          >
            {{ cat }}
          </button>
        </div>

        <!-- TABLE VIEW -->
        <div v-if="viewMode === 'table'" class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl shadow-purple-900/5 border border-white/80 ring-1 ring-purple-100/50 overflow-hidden">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-purple-100/60">
              <thead>
                <tr class="bg-gradient-to-r from-purple-50/70 via-pink-50/40 to-purple-50/70 text-slate-600 text-[11px] font-bold uppercase tracking-wider">
                  <th scope="col" class="py-4 pl-6 pr-3 text-left">Artikel & Judul</th>
                  <th scope="col" class="px-4 py-4 text-left">Kategori</th>
                  <th scope="col" class="px-4 py-4 text-left">Pembuat</th>
                  <th scope="col" class="px-4 py-4 text-left">Tanggal</th>
                  <th scope="col" class="py-4 pl-3 pr-6 text-right">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-100 bg-white/60">
                <tr 
                  v-for="item in filteredBeritas" 
                  :key="item.id" 
                  class="hover:bg-purple-50/40 transition-colors duration-150 group"
                >
                  <!-- Judul + Mini Thumbnail -->
                  <td class="py-4 pl-6 pr-3">
                    <div class="flex items-center gap-3.5">
                      <div class="w-12 h-12 rounded-2xl overflow-hidden bg-gradient-to-tr from-pink-100 to-purple-100 flex-shrink-0 flex items-center justify-center border border-purple-100 shadow-sm">
                        <img 
                          v-if="item.gambar" 
                          :src="item.gambar" 
                          :alt="item.judul"
                          class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" 
                          @error="(e) => e.target.style.display = 'none'"
                        />
                        <svg v-else class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                      </div>
                      <div class="max-w-xs sm:max-w-md">
                        <h4 class="font-bold text-slate-800 text-sm group-hover:text-purple-700 transition-colors line-clamp-1">
                          {{ item.judul }}
                        </h4>
                        <p class="text-xs text-slate-400 line-clamp-1 mt-0.5 font-normal">
                          {{ item.isian }}
                        </p>
                      </div>
                    </div>
                  </td>

                  <!-- Kategori -->
                  <td class="px-4 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-pink-50 to-purple-50 text-purple-700 border border-purple-200/60 shadow-sm">
                      {{ item.kategori }}
                    </span>
                  </td>

                  <!-- Pembuat -->
                  <td class="px-4 py-4 whitespace-nowrap">
                    <div class="flex items-center gap-2">
                      <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-pink-400 to-purple-500 text-white flex items-center justify-center text-xs font-bold shadow-sm">
                        {{ item.siapa_yang_buat ? item.siapa_yang_buat.charAt(0).toUpperCase() : 'A' }}
                      </div>
                      <span class="text-xs font-medium text-slate-700">{{ item.siapa_yang_buat }}</span>
                    </div>
                  </td>

                  <!-- Tanggal -->
                  <td class="px-4 py-4 whitespace-nowrap text-xs text-slate-500 font-medium">
                    <div class="flex items-center gap-1.5">
                      <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                      {{ formatDate(item.tanggal) }}
                    </div>
                  </td>

                  <!-- Aksi -->
                  <td class="py-4 pl-3 pr-6 whitespace-nowrap text-right">
                    <div class="flex items-center justify-end gap-2">
                      <!-- Edit Button -->
                      <button 
                        @click="editBerita(item)" 
                        type="button"
                        class="px-3 py-1.5 rounded-xl bg-purple-50 text-purple-700 hover:bg-purple-600 hover:text-white border border-purple-200/80 transition-all duration-150 text-xs font-semibold flex items-center gap-1 shadow-sm active:scale-95"
                        title="Edit Berita"
                      >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <span>Edit</span>
                      </button>

                      <!-- Delete Button -->
                      <button 
                        @click="deleteBerita(item.id)" 
                        type="button"
                        class="px-3 py-1.5 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white border border-rose-200/80 transition-all duration-150 text-xs font-semibold flex items-center gap-1 shadow-sm active:scale-95"
                        title="Hapus Berita"
                      >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span>Hapus</span>
                      </button>
                    </div>
                  </td>
                </tr>

                <!-- Empty State -->
                <tr v-if="filteredBeritas.length === 0">
                  <td colspan="5" class="py-12 text-center">
                    <div class="max-w-sm mx-auto space-y-3">
                      <div class="w-16 h-16 rounded-3xl bg-purple-50 text-purple-400 mx-auto flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                      </div>
                      <h4 class="font-bold text-slate-700">Belum Ada Berita Ditemukan</h4>
                      <p class="text-xs text-slate-400">Tidak ada data berita yang cocok dengan kata kunci atau filter yang Anda pilih.</p>
                      <button @click="resetFilters" type="button" class="text-xs font-semibold text-purple-600 hover:underline">
                        Reset Filter & Pencarian
                      </button>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- GRID CARD VIEW (Travel Experience Style) -->
        <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div 
            v-for="item in filteredBeritas" 
            :key="item.id" 
            class="bg-white/90 backdrop-blur-xl rounded-3xl overflow-hidden border border-white/90 shadow-xl shadow-purple-900/5 hover:shadow-2xl hover:shadow-purple-900/10 hover:-translate-y-1 transition-all duration-300 flex flex-col group ring-1 ring-purple-100/50"
          >
            <!-- Card Image Cover with Category Badge -->
            <div class="relative h-48 bg-gradient-to-tr from-pink-200 via-purple-100 to-indigo-100 overflow-hidden">
              <img 
                v-if="item.gambar" 
                :src="item.gambar" 
                :alt="item.judul"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                @error="(e) => e.target.style.display = 'none'"
              />
              <div v-else class="w-full h-full flex items-center justify-center text-purple-400">
                <svg class="w-12 h-12 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>

              <!-- Top Floating Category Pill -->
              <div class="absolute top-3 left-3">
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-white/90 backdrop-blur-md text-purple-700 shadow-md">
                  {{ item.kategori }}
                </span>
              </div>

              <!-- Top Date Badge -->
              <div class="absolute top-3 right-3">
                <span class="px-2.5 py-1 rounded-full text-[11px] font-medium bg-slate-900/60 backdrop-blur-md text-white">
                  {{ formatDate(item.tanggal) }}
                </span>
              </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 flex-1 flex flex-col justify-between">
              <div>
                <h3 class="text-base font-bold text-slate-800 group-hover:text-purple-600 transition-colors line-clamp-2 mb-2">
                  {{ item.judul }}
                </h3>
                <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed mb-4">
                  {{ item.isian }}
                </p>
              </div>

              <!-- Footer with Author & Action Buttons -->
              <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                  <div class="w-6 h-6 rounded-full bg-gradient-to-tr from-pink-400 to-purple-500 text-white flex items-center justify-center text-[10px] font-bold">
                    {{ item.siapa_yang_buat ? item.siapa_yang_buat.charAt(0).toUpperCase() : 'A' }}
                  </div>
                  <span class="text-xs font-medium text-slate-600 truncate max-w-[100px]">{{ item.siapa_yang_buat }}</span>
                </div>

                <div class="flex items-center gap-1.5">
                  <button 
                    @click="editBerita(item)" 
                    type="button" 
                    class="p-2 rounded-xl bg-purple-50 text-purple-700 hover:bg-purple-600 hover:text-white transition-all text-xs font-semibold"
                    title="Edit Berita"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                  </button>
                  <button 
                    @click="deleteBerita(item.id)" 
                    type="button" 
                    class="p-2 rounded-xl bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-all text-xs font-semibold"
                    title="Hapus Berita"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty Grid State -->
          <div v-if="filteredBeritas.length === 0" class="col-span-full py-12 text-center bg-white/80 rounded-3xl p-8 border border-slate-100">
            <h4 class="font-bold text-slate-700 mb-1">Belum Ada Berita Ditemukan</h4>
            <p class="text-xs text-slate-400 mb-3">Tidak ada data berita yang cocok dengan kriteria pencarian Anda.</p>
            <button @click="resetFilters" type="button" class="text-xs font-semibold text-purple-600 hover:underline">
              Reset Filter & Pencarian
            </button>
          </div>
        </div>

      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const config = useRuntimeConfig()
const apiBase = config.public?.apiBase || 'http://127.0.0.1:8000/api'

// State Reactive Berita
const beritas = ref([])
const isEdit = ref(false)
const editId = ref(null)
const isSubmitting = ref(false)
const imageLoadError = ref(false)
const formCardRef = ref(null)

// UI View & Filter State
const viewMode = ref('table')
const searchQuery = ref('')
const selectedCategory = ref('Semua')

// Notification State
const notification = ref({
  show: false,
  message: '',
  type: 'success'
})

const showToast = (message, type = 'success') => {
  notification.value = { show: true, message, type }
  setTimeout(() => {
    notification.value.show = false
  }, 4000)
}

// Quick Preset Categories for Travel Vibe
const quickCategories = ref([
  'Wisata & Tour',
  'Kuliner Lokal',
  'Budaya & Seni',
  'Penginapan',
  'Tips Perjalanan',
  'Pengumuman'
])

// Form State
const form = ref({
  judul: '',
  kategori: '',
  siapa_yang_buat: '',
  tanggal: '',
  gambar: '',
  isian: ''
})

// Dynamic Categories computed from existing data
const availableCategories = computed(() => {
  const cats = new Set()
  beritas.value.forEach(b => {
    if (b.kategori && b.kategori.trim()) {
      cats.add(b.kategori.trim())
    }
  })
  return Array.from(cats)
})

// Filtered and Searched Beritas
const filteredBeritas = computed(() => {
  return beritas.value.filter(item => {
    const matchCategory = selectedCategory.value === 'Semua' || 
      (item.kategori && item.kategori.toLowerCase() === selectedCategory.value.toLowerCase())
    
    if (!searchQuery.value.trim()) return matchCategory

    const query = searchQuery.value.toLowerCase()
    const matchTitle = item.judul ? item.judul.toLowerCase().includes(query) : false
    const matchCat = item.kategori ? item.kategori.toLowerCase().includes(query) : false
    const matchAuthor = item.siapa_yang_buat ? item.siapa_yang_buat.toLowerCase().includes(query) : false
    const matchContent = item.isian ? item.isian.toLowerCase().includes(query) : false

    return matchCategory && (matchTitle || matchCat || matchAuthor || matchContent)
  })
})

const resetFilters = () => {
  searchQuery.value = ''
  selectedCategory.value = 'Semua'
}

// Format Tanggal Estetik
const formatDate = (dateStr) => {
  if (!dateStr) return '-'
  try {
    const date = new Date(dateStr)
    return date.toLocaleDateString('id-ID', {
      day: 'numeric',
      month: 'short',
      year: 'numeric'
    })
  } catch {
    return dateStr
  }
}

// Fungsi Fetch Data Berita (READ)
const fetchBeritas = async () => {
  try {
    const res = await $fetch(`${apiBase}/beritas`)
    beritas.value = Array.isArray(res) ? res : (res?.data || [])
  } catch (err) {
    console.error('Error fetching data:', err)
  }
}

// Fungsi Simpan / Tambah / Update Berita (CREATE & UPDATE)
const saveBerita = async () => {
  isSubmitting.value = true
  try {
    if (isEdit.value) {
      await $fetch(`${apiBase}/beritas/${editId.value}`, {
        method: 'PUT',
        body: form.value
      })
      showToast('Berita berhasil diperbarui!', 'success')
    } else {
      await $fetch(`${apiBase}/beritas`, {
        method: 'POST',
        body: form.value
      })
      showToast('Berita baru berhasil dipublikasikan!', 'success')
    }
    resetForm()
    await fetchBeritas()
  } catch (err) {
    console.error('Error saving data:', err)
    showToast(err.data?.message || 'Terjadi kesalahan saat menyimpan data.', 'error')
  } finally {
    isSubmitting.value = false
  }
}

// Fungsi Edit Berita
const editBerita = (item) => {
  isEdit.value = true
  editId.value = item.id
  form.value = { ...item }
  
  // Smooth scroll up to form card
  if (formCardRef.value) {
    formCardRef.value.scrollIntoView({ behavior: 'smooth', block: 'center' })
  }
  showToast(`Sedang mengedit berita: "${item.judul}"`, 'success')
}

// Fungsi Hapus Berita (DELETE)
const deleteBerita = async (id) => {
  if (confirm('Yakin ingin menghapus berita ini? Tindakan ini tidak dapat dibatalkan.')) {
    try {
      await $fetch(`${apiBase}/beritas/${id}`, {
        method: 'DELETE'
      })
      showToast('Berita berhasil dihapus.', 'success')
      await fetchBeritas()
    } catch (err) {
      console.error('Error deleting data:', err)
      showToast('Gagal menghapus berita.', 'error')
    }
  }
}

// Reset Form
const resetForm = () => {
  isEdit.value = false
  editId.value = null
  imageLoadError.value = false
  form.value = {
    judul: '',
    kategori: '',
    siapa_yang_buat: '',
    tanggal: '',
    gambar: '',
    isian: ''
  }
}

onMounted(() => {
  fetchBeritas()
})
</script>

<style scoped>
/* Sembunyikan scrollbar untuk kategori chips yang rapi */
.no-scrollbar::-webkit-scrollbar {
  display: none;
}
.no-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>


<style scoped>
/* Sembunyikan scrollbar untuk kategori chips yang rapi */
.no-scrollbar::-webkit-scrollbar {
  display: none;
}
.no-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>