<template>
  <base-dialog></base-dialog>
</template>

<script>
import BaseDialog from './components/UI/BaseDialog.vue'
export default {
  components: { BaseDialog },
  name: 'App',
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

:root {
  --main-color: #363336;
  --main-color-light: #2e232e;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
html {
  font-family: 'Roboto', sans-serif;
}
</style>
