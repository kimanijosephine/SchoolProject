<template lang="html">
  <div class="flex h-screen w-full bg-zinc-50 p-3 md:p-6 overflow-hidden relative font-sans text-slate-900">

    <Transition name="fade">
      <div
        v-if="isMobileSidebarOpen"
        class="fixed inset-0 bg-zinc-900/60 z-40 backdrop-blur-md md:hidden"
        @click="closeMobileSidebar"
      ></div>
    </Transition>

    <aside
      :class="[
        'bg-[#121417] text-zinc-400 shadow-2xl transition-all duration-500 ease-[cubic-bezier(0.4,0,0.2,1)] z-50',
        'rounded-[2.5rem] flex flex-col justify-between overflow-hidden border border-white/5',
        // Mobile positioning
        'fixed inset-y-3 left-3 w-72',
        isMobileSidebarOpen ? 'translate-x-0' : '-translate-x-[115%]',
        // Desktop positioning
        'md:relative md:inset-auto md:translate-x-0 h-full',
        isDesktopSidebarExpanded ? 'md:w-72' : 'md:w-24'
      ]"
    >
      <div class="flex items-center justify-between p-8">
        <div class="flex items-center gap-4 overflow-hidden">
          <div class="w-11 h-11 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/20 flex-shrink-0 rotate-3">
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-7 h-7 text-emerald-950">
              <path d="M12 7.5a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z" />
              <path fill-rule="evenodd" d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v14.25c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 011.5 19.125V4.875zM11.25 12a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM4.5 6a.75.75 0 000 1.5h1.5A.75.75 0 006 6H4.5z" clip-rule="evenodd" />
            </svg>
          </div>
          <span :class="['font-bold text-xl text-white tracking-tight transition-all duration-500', !isDesktopSidebarExpanded && 'md:opacity-0 md:hidden']">
            Invest<span class="text-emerald-500">Ed</span>
          </span>
        </div>
        <button @click="closeMobileSidebar" class="md:hidden p-2 hover:bg-white/10 rounded-full transition-colors">
          <XMarkIcon class="w-6 h-6 text-white" />
        </button>
      </div>

      <nav class="flex-1 px-4 py-2 space-y-2 overflow-y-auto hide-scrollbar">
        <a
          v-for="item in navItems"
          :key="item.name"
          href="#"
          @click.prevent="activeTab = item.name"
          :class="[
            navClass,
            activeTab === item.name ? activeNavClass : 'hover:text-white hover:bg-white/5'
          ]"
        >
          <component :is="item.icon" class="w-6 h-6 flex-shrink-0" />
          <span :class="[labelClass, !isDesktopSidebarExpanded && 'md:opacity-0 md:w-0']">
            {{ item.name }}
          </span>

          <div
            v-if="!isDesktopSidebarExpanded"
            class="hidden md:group-hover:flex absolute left-20 ml-4 bg-[#1c1f24] text-white text-xs font-bold px-4 py-2 rounded-xl whitespace-nowrap z-[60] shadow-2xl border border-white/5"
          >
            {{ item.name }}
          </div>
        </a>
      </nav>

      <div class="p-6">
        <button
          @click="toggleDesktopSidebar"
          class="hidden md:flex w-full items-center justify-center p-4 rounded-3xl bg-white/5 hover:bg-emerald-500 hover:text-emerald-950 transition-all duration-300 group"
        >
          <ChevronDoubleLeftIcon v-if="isDesktopSidebarExpanded" class="w-5 h-5 transition-transform group-hover:-translate-x-1" />
          <ChevronDoubleRightIcon v-else class="w-5 h-5 transition-transform group-hover:translate-x-1" />
        </button>
      </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 ml-0 md:ml-6 h-full gap-6">

      <header class="bg-white/80 backdrop-blur-xl w-full rounded-[2.5rem] border border-white shadow-sm px-6 md:px-10 py-4 flex items-center justify-between z-10">
        <div class="flex items-center gap-4">
          <button @click="openMobileSidebar" class="md:hidden p-3 bg-zinc-100 rounded-2xl text-zinc-600">
            <Bars3Icon class="w-6 h-6" />
          </button>
          <div class="hidden md:block text-left">
            <p class="text-[10px] font-bold text-emerald-600 uppercase tracking-[0.2em] mb-0.5">Investor Access</p>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">
               <slot name="header-title">{{ activeTab }}</slot>
            </h1>
          </div>
        </div>

        <div class="flex items-center gap-2 md:gap-4">
          <button class="p-3 text-zinc-400 hover:bg-zinc-100 hover:text-emerald-600 rounded-2xl transition-all">
            <MagnifyingGlassIcon class="w-6 h-6" />
          </button>

          <button class="relative p-3 text-zinc-400 hover:bg-zinc-100 hover:text-emerald-600 rounded-2xl transition-all">
            <BellIcon class="w-6 h-6" />
            <span class="absolute top-3 right-3.5 w-2.5 h-2.5 bg-emerald-500 rounded-full border-2 border-white"></span>
          </button>

          <div class="flex items-center gap-3 ml-2 pl-4 border-l border-zinc-100">
            <div class="text-right hidden sm:block">
              <p class="text-sm font-bold text-slate-900">Sarah Jenkins</p>
              <p class="text-[10px] font-medium text-zinc-400 uppercase tracking-tighter">Premium Partner</p>
            </div>
            <img
              src="https://i.pravatar.cc/150?img=32"
              alt="Sarah"
              class="w-11 h-11 rounded-2xl object-cover ring-4 ring-emerald-50 shadow-md"
            >
          </div>
        </div>
      </header>

      <main class="flex-1 bg-white rounded-[2.5rem] border border-white shadow-xl shadow-zinc-200/50 p-6 md:p-10 overflow-y-auto relative custom-scrollbar">
        <slot />
      </main>

    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref } from 'vue';
import {
  Bars3Icon, XMarkIcon, ChevronDoubleLeftIcon, ChevronDoubleRightIcon,
  HomeIcon, UsersIcon, BellIcon, MagnifyingGlassIcon, ChartBarIcon, CreditCardIcon
} from '@heroicons/vue/24/outline';

// State
const isMobileSidebarOpen = ref(false);
const isDesktopSidebarExpanded = ref(true);
const activeTab = ref('Dashboard');

// Navigation configuration
const navItems = [
  { name: 'Dashboard', icon: HomeIcon },
  { name: 'My Students', icon: UsersIcon },
  { name: 'Performance', icon: ChartBarIcon },
  { name: 'Transactions', icon: CreditCardIcon },
];

// Reusable Tailwind Class strings
const navClass = "flex items-center gap-4 p-4 rounded-[1.5rem] transition-all duration-300 group relative";
const activeNavClass = "bg-emerald-500/10 text-emerald-400 shadow-[inset_0_0_20px_rgba(16,185,129,0.05)] border border-emerald-500/20";
const labelClass = "font-medium whitespace-nowrap transition-all duration-500 overflow-hidden";

// Actions
const openMobileSidebar = () => isMobileSidebarOpen.value = true;
const closeMobileSidebar = () => isMobileSidebarOpen.value = false;
const toggleDesktopSidebar = () => isDesktopSidebarExpanded.value = !isDesktopSidebarExpanded.value;
</script>

<style scoped>
/* Custom Scrollbar for the main content */
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

/* Hide Sidebar Scrollbar */
.hide-scrollbar::-webkit-scrollbar {
  display: none;
}
.hide-scrollbar {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

/* Page Fade Transition */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.4s ease;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
