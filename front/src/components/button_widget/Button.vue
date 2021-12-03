<template>
    <button class="btn-widget"><slot></slot></button>
</template>
<script>
export default {
    // props:['valueButton'],
}
</script>
<style>
    .btn-widget{
                padding: 12px;
                width: 40%;
                font-size: 15px;
                font-weight: bold;
                border: none;
                outline: none;
                border-radius: 10px;
                background: sandybrown;
                margin-top: 15px;
                
            }
</style>