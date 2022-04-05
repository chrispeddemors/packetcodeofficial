<template>
    <div>
        <button class='btn btn-primary ms-4' @click="followUser">Follow</button>
    </div>
</template>

<script>
    export default {

        mounted() {
            console.log('Component mounted.')
        },

        methods: { 
            followUser() { 
                alert('inside') ;
            } 
        }
    }

    
</script>
