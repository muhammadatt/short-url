<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        {{ status }}
                    </div>
                </div>
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
            status: 'Loading please wait...',
            loading: true
        };
    },

    computed: {},

    mounted() {

        axios
            .get("/api/" + this.shortcode)
            .then(response => {
                this.url = response.data;

                //TO DO: if (this.url.nsfw) show modal
                //else: 
                
                window.location.replace(this.url.url);

                //console.log(response);
            })
            .catch(err => {
                console.log(JSON.stringify(err.response));
                this.status = err.response.data.error.message;
                this.loading = false;
            });
    }
};
</script>

<style></style>
