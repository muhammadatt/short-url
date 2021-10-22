<template>
    <div>
        <modal v-if="modalOpen" @redirect="redirect"></modal>
        <div class="row justify-content-center">
            <div class="text-lg">
                {{ status }}
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
            status: "Loading please wait...",
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
                this.status = err.response.data.error.message;
                this.loading = false;
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
