<template>
    <div>
        <button class='btn btn-primary ms-4' @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
    export default {
        props: ['userId', 'follows'],

        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                status: this.follows,
            }
        },

        methods: {
            followUser() {
                axios.post('/follow/' + this.userId)
                .then(response => {
                    //? Everytime it makes a post, do the following :
                    //*Switch between true/false
                    this.status = ! this.status;
                    console.log(response.data );
                })
                .catch(errors => {
                    if(errors.response.status == 401) {
                        window.location = '/login';
                    }
                });
            }
        },
        computed: {
            buttonText() {
                //* If this returns: false = Unfollow, true = Follow
                return (this.status) ? 'Unfollow' : 'Follow';
            }
        }
    }
</script>
