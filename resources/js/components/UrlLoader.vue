<template>
    <div>
        <modal v-if="modalOpen" @redirect="redirect"></modal>
        <div class="row justify-content-center">
            <div v-if="loading" class="text-lg">
                Loading please wait...
            </div>
            <div v-if="error">

               <div class="text-lg">Unable to find the requested URL. Sorry, we looked everywhere.</div>

               <img class="mt-20" src="https://s3.us-west-2.amazonaws.com/images.onemonthspanish.com/Reading-list-bro-1.svg" />

            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        shortcode: {
            type: String,
            required: true
        }
    },

    data() {
        return {
            url: null,
            loading: true,
            modalOpen: false
        };
    },

    computed: {},

    mounted() {
        axios
            .get("/api/" + this.shortcode)
            .then(response => {
                this.url = response.data;

                if (this.url.nsfw) {
                    this.modalOpen = true;
                } else {
                    this.redirect();
                }

                //console.log(response);
            })
            .catch(err => {
                console.log(JSON.stringify(err.response));
                //this.error_msg = err.response.data.error.message;
                this.loading = false;
                this.error = true;
            });
    },

    methods: {
        redirect() {
            //Using location.replace removes the loader page the user's browser history
            window.location.replace(this.url.original);
        }
    }
};
</script>

<style></style>
