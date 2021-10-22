<template>
    <div v-if="short_url">
        <div class="flex flex-row">
           
            <div
                class="px-3 py-3 bg-white text-gray-400 overflow-hidden shadow rounded-lg w-full text-lg"
            >
                {{ short_url }}
            </div>
            <input
                ref="short_url"
                id="short_url"
                type="hidden"
                :value="short_url"
            />

            <button
                class="ml-2 bg-blue-600 text-white text-xl px-3 shadow rounded-lg"
                @click="copyLink"
            >
                Copiar
            </button>
        </div>
        <div>
            <a class="text-xs mt-2 text-xs text-blue-400" href="/">
                Submit a new link</a
            >
        </div>
    </div>

    <div v-else>
        <div v-if="error" class="text-white bg-red-400 rounded px-2 mb-4">
            Unable to shorten. Not a valid url.
        </div>
        <form action="">
            <div class="flex flex-row mb-2">
                <input
                    class="px-3 py-3 bg-white overflow-hidden shadow rounded-lg w-full text-lg"
                    id="url"
                    v-model="form.original"
                    placeholder="Acorta tu enlace"
                />

                <button
                    class="ml-3 bg-blue-600 text-white text-xl px-3 shadow rounded-lg"
                    @click.prevent="submit"
                >
                    Acortar
                </button>
            </div>

            <input
                type="checkbox"
                id="nsfw"
                name="nsfw"
                class="cursor-pointer"
                v-model="form.nsfw"
            />

            <label for="nsfw" class="text-xs text-gray-500 cursor-pointer"
                >Not safe for work?</label
            >
        </form>
    </div>
</template>

<script>
export default {
    props: {},

    data() {
        return {
            //form object
            form: {
                original: "", //original url
                nsfw: false //nsfw flag
            },
            short_url: null, //will contain the shortened url returned from the server
            error: false //form submit error status
        };
    },

    computed: {
        //Generates a base url from the current page/host
        //Consider replacing this with a reference to an environment value, e.g. process.env.APP_URL

        baseUrl() {
            return location.protocol + "//" + location.host;
        }
    },

    methods: {
        //copies the short url link to clipboard
        copyLink() {
            let input = this.$refs.short_url;
            input.setAttribute("type", "text");
            input.select();

            try {
                var successful = document.execCommand("copy");
                if (successful) alert("Link was copied!");
            } catch (err) {
                alert("Oops, unable to copy link");
            }

            /* unselect the range */
            input.setAttribute("type", "hidden");
            window.getSelection().removeAllRanges();
        },

        //submits the original url to the server and returns the short url link
        submit() {
            this.error = false;

            axios
                .post("/api/shorten", this.form)
                .then(response => {
                    //console.log(response);
                    this.short_url =
                        this.baseUrl + "/" + response.data.shortcode;
                })
                .catch(err => {
                    //console.log(JSON.stringify(err.response));

                    /** I'm currently validating urls on the backend and returning an error message 
                     * if validation fails. Ideally, we would also validate that the url is valid on the
                     * frontend before sending it to the server. 
                     * */

                    this.status = err.response.data.message;
                    this.error = true;
                });
        }
    },

    mounted() {}
};
</script>
