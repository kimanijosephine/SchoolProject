<template lang="html">
  <div class="flex h-screen w-full bg-zinc-100 p-4 md:p-6 gap-6 overflow-hidden relative font-sans text-slate-900">

    <Transition name="fade">
      <div
        v-if="isMobileSidebarOpen"
        class="fixed inset-0 bg-zinc-900/40 z-40 backdrop-blur-md md:hidden"
        @click="closeMobileSidebar"
      ></div>
    </Transition>

    <aside
      :class="[
        'bg-[#121417] text-zinc-400 shadow-2xl transition-all duration-500 ease-in-out z-50',
        'rounded-[2.5rem] flex flex-col justify-between overflow-hidden border border-white/5 shrink-0',
        // Mobile positioning
        'fixed inset-y-4 left-4 w-72',
        isMobileSidebarOpen ? 'translate-x-0' : '-translate-x-[115%]',
        // Desktop positioning
        'md:relative md:inset-auto md:translate-x-0 h-full',
        isDesktopSidebarExpanded ? 'md:w-72' : 'md:w-24'
      ]"
    >
      <div class="flex items-center justify-between p-8 h-24">
        <div class="flex items-center gap-4 overflow-hidden">
          <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/20 shrink-0">
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-emerald-950">
              <path fill-rule="evenodd" d="M12.516 2.17a.75.75 0 00-1.032 0 11.209 11.209 0 01-7.877 3.08.75.75 0 00-.722.515A12.74 12.74 0 002.25 9.75c0 5.942 4.064 10.933 9.563 12.348a.749.749 0 00.374 0c5.499-1.415 9.563-6.406 9.563-12.348 0-1.39-.223-2.73-.635-3.985a.75.75 0 00-.722-.516l-.143.001c-2.996 0-5.717-1.17-7.734-3.08zm3.094 8.08a.75.75 0 10-1.22-.87l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.122 2.12a.75.75 0 001.141-.094l3.877-5.425z" clip-rule="evenodd" />
            </svg>
          </div>
          <span :class="['font-bold text-lg text-white tracking-tight transition-opacity duration-300', !isDesktopSidebarExpanded && 'md:opacity-0']">
            InvestEd
          </span>
        </div>
        <button @click="closeMobileSidebar" class="md:hidden p-2 hover:bg-white/10 rounded-full transition-colors">
          <XMarkIcon class="w-6 h-6 text-white" />
        </button>
      </div>

      <nav class="flex-1 px-4 py-4 space-y-2 overflow-y-auto hide-scrollbar">
        <a v-for="item in navItems" :key="item.name" href="#" @click.prevent="activeTab = item.name"
          :class="[navClass, activeTab === item.name ? activeNavClass : 'hover:text-white hover:bg-white/5']">
          <component :is="item.icon" class="w-6 h-6 shrink-0" />
          <span :class="['font-medium whitespace-nowrap transition-all duration-300', !isDesktopSidebarExpanded && 'md:opacity-0 md:w-0']">
            {{ item.name }}
          </span>
          <div v-if="!isDesktopSidebarExpanded" class="hidden md:group-hover:flex absolute left-20 ml-4 bg-[#1c1f24] text-white text-xs font-bold px-4 py-2 rounded-xl whitespace-nowrap z-[60] shadow-2xl border border-white/5">
            {{ item.name }}
          </div>
        </a>
      </nav>

      <div class="p-6">
        <button @click="toggleDesktopSidebar"
          class="hidden md:flex w-full items-center justify-center p-4 rounded-3xl bg-white/5 hover:bg-emerald-500 hover:text-emerald-950 transition-all duration-300 group">
          <ChevronDoubleLeftIcon v-if="isDesktopSidebarExpanded" class="w-5 h-5 transition-transform group-hover:-translate-x-1" />
          <ChevronDoubleRightIcon v-else class="w-5 h-5 transition-transform group-hover:translate-x-1" />
        </button>
      </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 h-full gap-6">

      <header class="bg-white w-full rounded-[2.5rem] shadow-xl shadow-zinc-200/50 px-6 md:px-10 py-4 flex items-center justify-between shrink-0 h-24">
        <div class="flex items-center gap-4">
          <button @click="openMobileSidebar" class="md:hidden p-3 bg-zinc-100 rounded-2xl text-zinc-600">
            <Bars3Icon class="w-6 h-6" />
          </button>
          <div class="hidden md:block">
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">{{ activeTab }}</h1>
            <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-[0.2em]">Management System</p>
          </div>
        </div>

        <div class="flex items-center gap-3">
          <button class="hidden sm:flex p-3 text-zinc-400 hover:bg-zinc-50 hover:text-emerald-600 rounded-2xl transition-all">
            <BellIcon class="w-6 h-6" />
          </button>

          <div class="relative">
            <button @click="isProfileOpen = !isProfileOpen"
              class="flex items-center gap-3 p-1.5 pr-4 rounded-[1.5rem] hover:bg-zinc-50 transition-all border border-transparent hover:border-zinc-100"
              :class="{ 'bg-zinc-50 border-zinc-100': isProfileOpen }"
            >
              <img src="https://i.pravatar.cc/150?img=32" class="w-10 h-10 rounded-2xl object-cover shadow-sm">
              <div class="text-left hidden lg:block">
                <p class="text-xs font-bold text-slate-900">Sarah Jenkins</p>
                <ChevronDownIcon class="w-3 h-3 text-zinc-400 mt-0.5" />
              </div>
            </button>

            <Transition name="pop">
              <div v-if="isProfileOpen"
                class="absolute right-0 mt-3 w-56 bg-white rounded-[2rem] shadow-2xl border border-zinc-100 p-3 z-[100]">
                <div class="px-4 py-3 border-b border-zinc-50 mb-2">
                  <p class="text-xs font-medium text-zinc-400 uppercase">Investor ID</p>
                  <p class="text-sm font-bold text-slate-900">INV-9920-X</p>
                </div>
                <button class="w-full flex items-center gap-3 p-3 text-slate-600 hover:bg-zinc-50 rounded-2xl transition-colors">
                  <UserCircleIcon class="w-5 h-5" />
                  <span class="text-sm font-semibold">Settings</span>
                </button>
                <button class="w-full flex items-center gap-3 p-3 text-red-500 hover:bg-red-50 rounded-2xl transition-colors">
                  <ArrowRightOnRectangleIcon class="w-5 h-5" />
                  <span class="text-sm font-bold">Logout</span>
                </button>
              </div>
            </Transition>
          </div>
        </div>
      </header>

      <main class="flex-1 bg-white rounded-[2.5rem] shadow-xl shadow-zinc-200/40 p-6 md:p-10 overflow-y-auto custom-scrollbar border border-white">
        <slot>
           <div class="h-[150vh] bg-gradient-to-b from-zinc-50 to-white rounded-3xl border-2 border-dashed border-zinc-100 flex items-start justify-center p-20">
              <p class="text-zinc-300 font-medium">Main Content Area (Scrollable)</p>
           </div>
        </slot>
      </main>

    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref, onMounted, onUnmounted } from 'vue';
import {
  Bars3Icon, XMarkIcon, ChevronDoubleLeftIcon, ChevronDoubleRightIcon,
  HomeIcon, UsersIcon, BellIcon, ChevronDownIcon, UserCircleIcon,
  ArrowRightOnRectangleIcon, ChartBarSquareIcon, WalletIcon
} from '@heroicons/vue/24/outline';

// State Logic
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

// Helper Classes
const navClass = "flex items-center gap-4 p-4 rounded-[1.5rem] transition-all duration-300 group relative";
const activeNavClass = "bg-emerald-500 text-emerald-950 shadow-lg shadow-emerald-500/20";

// Actions
const openMobileSidebar = () => isMobileSidebarOpen.value = true;
const closeMobileSidebar = () => isMobileSidebarOpen.value = false;
const toggleDesktopSidebar = () => isDesktopSidebarExpanded.value = !isDesktopSidebarExpanded.value;

// Close dropdown on click outside
const closePopups = (e: MouseEvent) => {
  if (isProfileOpen.value && !(e.target as Element).closest('.relative')) {
    isProfileOpen.value = false;
  }
};
onMounted(() => window.addEventListener('click', closePopups));
onUnmounted(() => window.removeEventListener('click', closePopups));
</script>

<style scoped>
/* Smooth Pop Animation for Dropdown */
.pop-enter-active { transition: all 0.2s ease-out; }
.pop-leave-active { transition: all 0.1s ease-in; }
.pop-enter-from, .pop-leave-to { opacity: 0; transform: translateY(-10px) scale(0.95); }

/* Transitions */
.fade-enter-active, .fade-leave-active { transition: opacity 0.3s ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }

/* Custom Scrollbar */
.custom-scrollbar::-webkit-scrollbar { width: 8px; }
.custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #e4e4e7;
  border-radius: 20px;
  border: 2px solid white;
}

.hide-scrollbar::-webkit-scrollbar { display: none; }
.hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
