<template>
   <!-- v-text=buttonText: change text within a button after an event*/ -->
    <div class="container">
        <button class="btn btn-primary ms-3" @click="followUser" v-text="buttonText"></button>     
    </div>
</template>

<script>
    export default {
    //compon prop received from index.view
        props: ['userId', 'follows'],

        mounted() {
            console.log('Component mounted.')
        },
    //default state, whether or not a user's following the profile //if yes, this.follows= true
        data: function () {
            return {
                status: this.follows,
            }
        },

    // Click.event makes post request to this route, run call-back function and get response
        methods: {
            followUser() {
                axios.post('/follow/' + this.userId)
                    .then(response => {
                        this.status = ! this.status;
                        console.log(response.data);
                    })
    // error code= 401 means current user is Not logged in
                    .catch(errors => {
                        if (errors.response.status == 401) {
                            window.location = '/login';
                        }
                    });              
            }
        },

        computed: {
            buttonText() {
                return (this.status) ? 'Unfollow': 'Follow';
            }
        }

    }
</script>
