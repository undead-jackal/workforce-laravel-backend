<template>
    <div class="j-modal"  v-if="value">
        <div class="content">
            <slot></slot>
        </div>
        <div class="backdrop" @click="close()"></div>
    </div>
</template>
<script>

export default {
    props: {
            value: {
                required: true
            }
        },
    methods: {
        close() {
            document.getElementById('app').classList.remove("j-modal-open");
            this.$emit("input", !this.value);
        } 
    }  
}
</script>
<style>
/* JMODAL */
.j-modal-open *{
    overflow: hidden;
}

.j-modal{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    max-height: 100vh;
    height: 100%;
    background-color: #242424CC;
    z-index: 3;
}

.j-modal .backdrop{
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    max-height: 100vh;
    height: 100%;
    background-color:transparent;
}


</style>