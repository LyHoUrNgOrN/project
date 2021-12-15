<template>
    <header>
      <li class="header">{{title}}</li>
    </header>
</template>

<script>
export default {
    props:['title']
}
</script>

<style scoped>
    header{
      padding: 20px;
      background: #154360;
      color: white;
      position: sticky;
      top: 142px;
      z-index: 2;
    }
    .header{
      list-style: none;
      display: flex;
      justify-self: start;
      align-items: flex-start;
      margin-left: 20px;
      font-size: 20px;

    }
</style>