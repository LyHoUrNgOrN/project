<template>
    <div class="cardHead">
        <slot></slot>
    </div>
</template>

<script>
export default {

}
</script>

<style>

    .cardHead{
        margin-top: 60px;
        margin-bottom: 20px;
        margin-left: 55px;
        border-bottom: 2px solid gray;
        width: 90%;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        position: sticky;
        top: 165px;
        z-index: 5;

    }
    .cardHead h3{
        color: white;
    }
    

</style>