<template>
  <footer className="bg-gray-900 text-gray-400 py-12 px-4 sm:px-6 lg:px-8">
    <div className="max-w-4xl mx-auto">
      <div className="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
        <div>
          <div className="flex items-center gap-2 mb-4">
            <div
              className="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
              <span className="text-white font-bold text-lg">E</span>
            </div>
            <span className="text-xl font-bold text-white">EDU</span>
          </div>
          <p className="text-sm">Empowering education through transparency.</p>
        </div>
        <div>
          <h4 className="text-white font-semibold mb-4">Product</h4>
          <ul className="space-y-2 text-sm">
            <li><a href="#" className="hover:text-white transition">Features</a></li>
            <li><a href="#" className="hover:text-white transition">Pricing</a></li>
            <li><a href="#" className="hover:text-white transition">Security</a></li>
          </ul>
        </div>
        <div>
          <h4 className="text-white font-semibold mb-4">Company</h4>
          <ul className="space-y-2 text-sm">
            <li><a href="#" className="hover:text-white transition">About</a></li>
            <li><a href="#" className="hover:text-white transition">Blog</a></li>
            <li><a href="#" className="hover:text-white transition">Contact</a></li>
          </ul>
        </div>
        <div>
          <h4 className="text-white font-semibold mb-4">Legal</h4>
          <ul className="space-y-2 text-sm">
            <li><a href="#" className="hover:text-white transition">Privacy</a></li>
            <li><a href="#" className="hover:text-white transition">Terms</a></li>
            <li><a href="#" className="hover:text-white transition">Compliance</a></li>
          </ul>
        </div>
      </div>

      <div className="border-t border-gray-800 pt-8 text-center text-sm">
        <p>&copy; {{ year }} EDU Platform. Empowering education worldwide.</p>
      </div>
    </div>
  </footer>
</template>

<script setup lang="ts">
import { ref } from "vue"

const year = ref(new Date().getFullYear())
</script>

<<<<<<< HEAD
<style scoped>
.site-footer {
  padding: 60px 10%;
  background: linear-gradient(to bottom, #000000, #0f172a); /* Fades from pure black to deep navy */
  border-top: 1px solid rgba(255, 255, 255, 0.05);
}

.footer-content {
  display: flex;
  justify-content: space-between;
  gap: 40px;
  flex-wrap: wrap; /* Stacks on mobile */
  max-width: 1000px;
  margin: 0 auto;
}

.footer-column {
  flex: 1;
  min-width: 280px;
}

.footer-label {
  color: #818cf8; /* That same soft indigo from your body */
  font-size: 0.8rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-bottom: 15px;
}

.footer-text {
  color: #64748b; /* Muted slate color for secondary info */
  line-height: 1.6;
  font-size: 0.95rem;
  font-style: italic; /* Makes Vision/Mission feel more inspirational */
}

/* The vertical line between Mission and Vision */
.footer-divider {
  width: 1px;
  background: rgba(255, 255, 255, 0.1);
  margin: 0 20px;
}

.footer-bottom {
  margin-top: 50px;
  text-align: center;
  border-top: 1px solid rgba(255, 255, 255, 0.05);
  padding-top: 25px;
}

.footer-bottom p {
  color: #475569;
  font-size: 0.8rem;
}

/* Mobile Fix: Hide divider when stacked */
@media (max-width: 768px) {
  .footer-divider { display: none; }
  .footer-content { text-align: center; }
}
</style>
=======
<style scoped></style>
>>>>>>> 16319331735ab9d65f3928f0baa7b2a1b854f0d1
