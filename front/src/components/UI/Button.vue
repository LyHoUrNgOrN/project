<template>
    <button class="btn">
        <slot></slot>
    </button>
</template>
<script>
export default {

}
</script>
<style scoped>
    .btn{
        padding: 12px;
        width: 100px;
        font-size: 15px;
        font-weight: bold;
        border: none;
        outline: none;
        border-radius: 10px;
        background: #154360;
        margin-top: 15px;
        color: white;
    }
</style>