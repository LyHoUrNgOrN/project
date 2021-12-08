<template>
  <button :class="mode">
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: ['mode'],
};
</script>

<style scoped>
button {
  padding: 7px 7px;
  font-family: inherit;
  outline: none;
  background-color: rgba(97, 7, 7, 0.397);
  border: 1px solid rgba(190, 0, 0, 0.363);
  color: white;
  cursor: pointer;
}

button:hover,
button:active {
  background-color: var(--main-color-light);
  border-color: var(--main-color-light);
}

.flat {
  background-color: transparent;
  color: var(--main-color);
  border: none;
}

.flat:hover,
.flat:active {
  background-color: #edd2ff;
}
</style>