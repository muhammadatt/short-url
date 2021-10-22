<template>
    <div class="flex flex-row justify-center">
        <div class="max-w-3xl">
            <div
                class="text-2xl text-center font-bold my-5 text-color-gray-600"
            >
                Top 100 Most Visited Urls
            </div>
            <div v-for="(url, index) in urlList" class="mb-2">
                <div class="flex flex-row justify-between">
                    <div class="text-base">
                        {{ index + 1 + ". " }}
                        <a :href="baseUrl + '/' + url.shortcode">
                            {{ baseUrl + "/" + url.shortcode }}</a
                        >
                    </div>
                    <div class="text-xs text-gray-400">
                        views: {{ url.view_count.toLocaleString() }}
                    </div>
                </div>

                <div class="text-sm text-gray-400">{{ url.original }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {},

    data() {
        return {
            urlList: null
        };
    },

    computed: {
        baseUrl() {
            return location.protocol + "//" + location.host;
        }
    },

    mounted() {
        //request the list of top 100 urls from our REST API endpoint when the component is mounted
        axios
            .get("/api/top")
            .then(response => {
                this.urlList = response.data;
            })
            .catch(err => {
                //console.log(JSON.stringify(err.response));
            });
    }
};
</script>

<style></style>
