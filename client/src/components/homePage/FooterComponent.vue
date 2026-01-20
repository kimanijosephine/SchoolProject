<template>
  <footer class="footer">
    <p>© {{ year }} SchoolPay</p>
    <small>Simplifying school fees payment</small>
  </footer>
</template>

<script>
export default {
  name: "AppFooter",
  data() {
    return {
      year: new Date().getFullYear(),
    };
  },
};
</script>

<style scoped>
.footer {
  background: #f1f5f9;
  text-align: center;
  padding: 20px;
  margin-top: 50px;
}
</style>
