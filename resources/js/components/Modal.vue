<template>
    <div class="fixed z-50 inset-0 overflow-y-auto">
      <div
        class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0"
      >

        <!--Background-->
        <div
          class="fixed inset-0 transition-opacity"
          aria-hidden="true"
        >
          <div class="absolute inset-0 bg-gray-500 opacity-95"></div>
        </div>

        <!-- The Modal -->

        <div
          class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
          style="width:500px"
        >

            <slot name="body">

              <div class=" pr-2 pb-9">

                <div class="px-6 py-6 flex flex-col justify-end">

                  <div class="text-gray-700 text-xl">
                  WARNING: This link contains material that may not be suitable for work.
                  </div>

                  <div class="flex flex-row mt-3">

                    <a
                      type="button"
                      style="border: 1px solid rgb(196 196 196);"
                      class="w-full inline-flex justify-center hover:no-underline rounded-md shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm mr-3"
                     href="/"
                    >
                    <span class="">Go back to safety</span>
                      
                    </a>

                    <button
                      type="button"
                      class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:w-auto sm:text-sm"
                      @click="$emit('redirect')"
                    >
                    
                    <span class="">Let me in</span>
                    </button>

                  </div>
                </div>

              </div>
            </slot>

       
        </div>
      </div>
    </div>
</template>

<script>


export default {
  components: {  },
  name: "nsfw-modal",
  data: function() {
    return {

    };
  },
  computed: {

  },
  methods: {

  }

};
</script>
