<template lang="html">
  <div class="flex h-screen w-full bg-zinc-100 p-4 md:p-6 gap-6 overflow-hidden relative font-sans text-slate-900">

    <Transition name="fade">
      <div v-if="isMobileSidebarOpen" class="fixed inset-0 bg-zinc-900/50 z-40 backdrop-blur-md md:hidden"
        @click="closeMobileSidebar"></div>
    </Transition>

<aside :class="[
  'bg-[#121417] text-zinc-400 shadow-2xl transition-all duration-500 ease-in-out z-50',
  'rounded-[2.5rem] flex flex-col justify-between overflow-hidden border border-white/5 shrink-0',
  // Mobile: Always full width (w-72) when visible
  'fixed inset-y-6 left-6 w-72',
  isMobileSidebarOpen ? 'translate-x-0' : '-translate-x-[120%]',
  // Desktop: Logic remains for expand/collapse
  'md:relative md:inset-auto md:translate-x-0 h-full',
  isDesktopSidebarExpanded ? 'md:w-72' : 'md:w-24'
]">

  <div class="flex items-center h-24 overflow-hidden px-6">
    <div :class="[
      'flex items-center w-full transition-all duration-500',
      // Force justify-start on mobile regardless of desktop state
      'justify-start gap-4 md:justify-start',
      !isDesktopSidebarExpanded ? 'md:justify-center md:gap-0' : 'md:gap-4'
    ]">
      <div class="w-11 h-11 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/20 shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 text-emerald-950">
          <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.08a.75.75 0 10-1.22-.87l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.122 2.12a.75.75 0 001.141-.094l3.877-5.425z" clip-rule="evenodd" />
        </svg>
      </div>
      <span :class="['font-bold text-xl text-white tracking-tight whitespace-nowrap animate-in fade-in duration-500', !isDesktopSidebarExpanded ? 'md:hidden' : 'block']">
        Invest<span class="text-emerald-500">Ed</span>
      </span>
    </div>
  </div>

  <nav class="flex-1 px-4 py-8 overflow-y-auto hide-scrollbar">
    <a v-for="item in navItems" :key="item.name" href="#" @click.prevent="activeTab = item.name"
      :class="[
        navClass,
        'my-2',
        activeTab === item.name ? activeNavClass : 'hover:text-white hover:bg-white/5',
        // Desktop handles centering, Mobile is always full width with padding
        !isDesktopSidebarExpanded ? 'md:justify-center px-6 md:px-0' : 'px-6'
      ]" style="margin-top: 0.5rem; margin-bottom: 0.5rem;">

      <component :is="item.icon" class="w-6 h-6 shrink-0" />

      <span :class="['font-medium whitespace-nowrap ml-1', !isDesktopSidebarExpanded ? 'md:hidden' : 'block']">
        {{ item.name }}
      </span>

      <div v-if="!isDesktopSidebarExpanded"
        class="hidden md:group-hover:flex absolute left-20 ml-4 bg-[#1c1f24] text-white text-xs font-bold px-4 py-2 rounded-xl whitespace-nowrap z-60 shadow-2xl border border-white/5">
        {{ item.name }}
      </div>
    </a>
  </nav>

  <div class="hidden md:block px-4 pb-8 mt-auto">
    <button @click="toggleDesktopSidebar" class="relative flex items-center h-14 w-full rounded-2xl transition-all duration-500 ease-in-out group overflow-hidden
       bg-white/3 border border-white/5 hover:border-emerald-500/30 hover:bg-emerald-500/8"
      :class="isDesktopSidebarExpanded ? 'px-5' : 'justify-center px-0'">

      <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500
          bg-[radial-gradient(circle_at_center,var(--tw-gradient-stops))] from-emerald-500/10 via-transparent to-transparent">
      </div>

      <div :class="['flex items-center transition-all duration-500', isDesktopSidebarExpanded ? 'gap-4' : '']">
        <div class="relative">
          <ChevronDoubleLeftIcon :class="[
            'w-5 h-5 transition-all duration-700 ease-in-out',
            isDesktopSidebarExpanded ? 'text-zinc-500 group-hover:text-emerald-400' : 'text-emerald-500 rotate-180'
          ]" />
        </div>

        <div v-if="isDesktopSidebarExpanded" class="h-4 w-px bg-white/10 group-hover:bg-emerald-500/30 transition-colors"></div>

        <div v-if="isDesktopSidebarExpanded" class="flex flex-col items-start leading-none">
          <span class="text-[10px] font-black uppercase tracking-[0.25em] text-zinc-500 group-hover:text-emerald-400 transition-colors">
            Sidebar
          </span>
          <span class="text-[9px] font-medium text-zinc-600 mt-1 uppercase tracking-widest">
            Minimize
          </span>
        </div>
      </div>

      <div v-if="!isDesktopSidebarExpanded" class="absolute bottom-1 w-1 h-1 bg-emerald-500/40 rounded-full"></div>
    </button>
  </div>
</aside>

    <div class="flex-1 flex flex-col min-w-0 h-full gap-6">
      <!-- Header  -->
      <header
        class="bg-white w-full rounded-[2.5rem] shadow-xl shadow-zinc-200/50 px-8 py-0 flex items-center justify-between shrink-0 h-20 border border-white">
        <div class="flex items-center gap-4">
          <button @click="openMobileSidebar" class="md:hidden p-3 bg-zinc-100 rounded-2xl text-zinc-600">
            <Bars3Icon class="w-6 h-6" />
          </button>
          <div class="hidden md:block">
            <h1 class="text-2xl font-black text-slate-900 tracking-tight leading-none">{{ activeTab }}</h1>
            <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-[0.2em] mt-1">Institutional Portal</p>
          </div>
        </div>

        <div class="flex items-center gap-4">
          <button
            class="hidden sm:flex p-3 text-zinc-400 hover:bg-zinc-50 hover:text-emerald-600 rounded-2xl transition-all">
            <BellIcon class="w-6 h-6" />
          </button>

          <div class="relative">
            <button @click.stop="isProfileOpen = !isProfileOpen"
              class="flex items-center gap-3 p-1.5 pr-4 rounded-[1.8rem] hover:bg-zinc-200 transition-all border border-transparent hover:border-zinc-200"
              :class="{ 'bg-zinc-200 border-zinc-100': isProfileOpen }">
              <img src="https://i.pravatar.cc/150?img=32"
                class="w-10 h-10 rounded-2xl object-cover shadow-sm ring-2 ring-emerald-50">
              <div class="text-left hidden lg:block">
                <p class="text-xs font-bold text-slate-900 leading-none">Sarah Jenkins</p>
                <p class="text-[9px] font-medium text-zinc-400 mt-1">ID: #4402</p>
              </div>
            </button>

            <Transition name="pop">
              <div v-if="isProfileOpen"
                class="absolute right-0 mt-3 w-60 bg-white rounded-4x1 shadow-2xl border border-zinc-100 p-3 rounded-2xl z-100">
                <div class="px-4 py-3 border-b border-zinc-50 mb-2">
                  <p class="text-xs font-medium text-zinc-400 uppercase">Account</p>
                  <p class="text-sm font-bold text-slate-900">Premium Investor</p>
                </div>
                <button
                  class="w-full flex items-center gap-3 p-3 text-slate-600 hover:bg-zinc-200 rounded-2xl transition-colors">
                  <UserCircleIcon class="w-5 h-5" />
                  <span class="text-sm font-semibold">My Settings</span>
                </button>
                <button
                  class="w-full flex items-center gap-3 p-3 text-red-500 hover:bg-red-50 rounded-3xl transition-colors">
                  <ArrowRightStartOnRectangleIcon class="w-5 h-5" />
                  <span class="text-sm font-bold">Logout Session</span>
                </button>
              </div>
            </Transition>
          </div>
        </div>
      </header>
      <!-- Main Body for content -->
      <main
        class="flex-1 bg-white rounded-[2.5rem] shadow-xl shadow-zinc-200/40 p-8 md:p-10 overflow-y-auto custom-scrollbar border border-white">
        <slot>
        </slot>
      </main>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref, onMounted, onUnmounted } from 'vue';
import {
  Bars3Icon, ChevronDoubleLeftIcon,
  HomeIcon, UsersIcon, BellIcon, UserCircleIcon,
  ArrowRightStartOnRectangleIcon, ChartBarSquareIcon, WalletIcon
} from '@heroicons/vue/24/outline';

const isMobileSidebarOpen = ref(false);
const isDesktopSidebarExpanded = ref(true);
const isProfileOpen = ref(false);
const activeTab = ref('Dashboard');

const navItems = [
  { name: 'Dashboard', icon: HomeIcon },
  { name: 'My Students', icon: UsersIcon },
  { name: 'Performance', icon: ChartBarSquareIcon },
  { name: 'Wallet', icon: WalletIcon },
];

const navClass = "flex items-center gap-4 p-4 rounded-[1.5rem] transition-all duration-300 group relative";
const activeNavClass = "bg-emerald-500 text-emerald-950 shadow-xl shadow-emerald-500/20 font-bold";

const openMobileSidebar = () => isMobileSidebarOpen.value = true;
const closeMobileSidebar = () => isMobileSidebarOpen.value = false;
const toggleDesktopSidebar = () => isDesktopSidebarExpanded.value = !isDesktopSidebarExpanded.value;

// Close dropdown on click outside
const closePopups = () => isProfileOpen.value = false;
onMounted(() => window.addEventListener('click', closePopups));
onUnmounted(() => window.removeEventListener('click', closePopups));
</script>

<style scoped>
/* Smooth Pop-out Animation for Profile Menu */
.pop-enter-active {
  transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.pop-leave-active {
  transition: all 0.15s ease-in;
}

.pop-enter-from,
.pop-leave-to {
  opacity: 0;
  transform: translateY(-12px) scale(0.9);
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Elegant Custom Scrollbar */
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #f1f1f1;
  border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #e4e4e7;
}

.hide-scrollbar::-webkit-scrollbar {
  display: none;
}

.hide-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
