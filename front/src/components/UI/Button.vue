<template>
    <button class="btn">
        <slot></slot>
    </button>
</template>
<script>
export default {
    // props:['valueButton'],
}
</script>
<style>
    .btn{
                padding: 12px;
                width: 40%;
                font-size: 15px;
                font-weight: bold;
                border: none;
                outline: none;
                border-radius: 10px;
                background: rgb(44, 171, 209);
                margin-top: 15px;
                color: white;
            }
</style>