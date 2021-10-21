<template>
    <div v-if="short_url">
        <div class="flex flex-row">
            <div
                class="px-3 py-3 bg-white text-gray-400 overflow-hidden shadow rounded-lg w-full text-lg"
            >
                {{ short_url }} 
            </div>

            <button
                class="ml-2 bg-blue-600 text-white text-xl px-3 shadow rounded-lg"
                @click="copyLink"
            >
            Copiar
            </button>
            
        </div>
        <div>
                <a class="text-xs mt-2 text-xs text-blue-400" href="/"> Submit a new link</a>
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
                    ref="form"
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
            form: {
                original: "", //original url
                nsfw: false //nsfw flag
            },
            short_url: null,
            error: false
        };
    },

    computed: {},

    methods: {

    copyLink() {
      let link = document.getElementById("url"); 
      /* Select the input field */
      link.select();
      link.setSelectionRange(0, 99999); /* For mobile devices */

      /* Copy the text inside the textarea field */
      document.execCommand("copy");

    },
        submit() {
            this.error = false;

            axios
                .post("/api/shorten", this.form)
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
