<template>
    <button class="btn">{{valueButton}}</button>
</template>
<script>
export default {
    props:['valueButton'],
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
                background: sandybrown;
                margin-top: 15px;
                
            }
</style>