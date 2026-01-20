<template lang="html">
  <header class="header">
    <div class="logo">
      <h2>SCHOOL FEES </h2>
    </div>

    <nav class="nav">
      <router-link to="/">Home</router-link>
      <router-link to="/login">Login</router-link>
      <router-link to="/register">Register</router-link>
    </nav>
  </header>
</template>

<script setup lang="ts">

</script>

<style scoped>
.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 30px;
  background-color: #2563eb;
  color: white;
}

.logo h2 {
  margin: 0;
}

.nav {
  display: flex;
  gap: 20px;
}

.nav a {
  color: white;
  text-decoration: none;
  font-weight: 500;
}

.nav a.router-link-active {
  text-decoration: underline;
}
</style>
