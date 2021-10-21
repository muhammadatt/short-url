<template>
    <div class="container">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        
                        <div v-for="url in urlList" :key="url.id" class="mb-2">
                            
                            <div class="flex flex-row justify-between">
                            <div class="text-base"> <a :href="baseUrl + '/' + url.shortcode"> {{ baseUrl + '/' + url.shortcode }}</a> </div>
                            <div class="text-xs text-gray-400"> views: {{ url.view_count.toLocaleString() }} </div>
                            </div>

                            <div class="text-sm text-gray-400"> {{ url.original }} </div>
                        </div>

                    </div>
                </div>
            </div>
    
    </div>
</template>

<script>
export default {
    props: {

    },

    data() {
        return {
            urlList: null,
            loading: true
        };
    },

    computed: {

        baseUrl(){
            return location.protocol + '//' + location.host;
        }

    },

    mounted() {
        axios
            .get("/api/top")
            .then(response => {
                this.urlList = response.data;
            })
            .catch(err => {
                console.log(JSON.stringify(err.response));
                this.status = err.response.data.message;
                this.loading = false;
            });
    }
};
</script>

<style></style>
