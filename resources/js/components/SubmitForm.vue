<template>
   
   <div v-if="short_url">
    <div class="px-3 mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg h-10 w-full text-lg"> {{ short_url }}</div>
   
    <button class="border border-solid border-gray-700 px-3 h-12 rounded-lg">Copy</button>
   </div>

    <div v-else>

        <div v-if="error" class="text-white bg-red-400 rounded px-2">Unable to shorten. Not a valid url.</div>
        <form action="">

            <input
                class="px-3 mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg h-12 w-full text-lg"
                v-model="post.url"

            />

            <input type="checkbox" name="nsfw" class="mt-3" v-model="post.nsfw" />

            <label for="nsfw" class="text-xs text-gray-500"
                >Not safe for work?</label
            >

        </form>

        
    </div>
</template>

<script>
export default {
    props: {

    },

    data() {
        return {
            post: {
                url: "",
                nsfw: false
            },
            short_url: null,
            error: false
        };
    },

    computed: {},

    methods: {
        submit() {

            this.error = false;

            axios
                .post("/api/shorten", this.post)
                .then(response => {
                    //this.url = response.data;

                    //console.log(response);
                    this.short_url = response.data.short;
                })
                .catch(err => {
                    console.log(JSON.stringify(err.response));
                    this.status = err.response.data.message;
                    this.error = true;
                });
        }
    },

    mounted() {}
};
</script>
