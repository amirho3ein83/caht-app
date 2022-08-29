<template>
    <div class=" sm:items-center justify-around ">
        <div class="relative flex items-center space-x-4 justify-center">
            <div class="relative p-1">
                <div class="relative">
                    <img
                        class="w-10 sm:w-16 h-10 sm:h-16 rounded-full"
                        :src="$page.props.user.profile"
                    />

                    <div
                        v-if="second_contact.status == `online`"
                        class="absolute button-0 right-0 -mr-0 -mt-4 w-4 h-4 rounded-full bg-green-400 animate-ping"
                    ></div>
                    <div
                        v-if="second_contact.status == `online`"
                        class="absolute button-0 right-0 -mr-0 -mt-4 w-4 h-4 rounded-full bg-green-400"
                    ></div>
                </div>
            </div>
            <div class="flex flex-col leading-tight">
                <div class="text-2xl mt-1 flex items-center">
                    <span class="text-gray-100 mr-3"
                        >{{ second_contact.name }}
                    </span>
                </div>
                <span v-if="second_contact.status" class="text-sm text-gray-100"
                    >{{ second_contact.status }}
                </span>
            </div>
        </div>
    <hr class=" bg-gray-800 my-2">
    </div>
</template>

<script>
export default {
    props: ["second_contact"],
    // data: function () {
    //     return {
    //         second_contact: [],
    //     };
    // },
    // created() {
    //     console.log(this.second_contact);
    //         axios
    //             .get("second_contact/" + this.second_contact.id)
    //             .then((response) => {
    //                 this.second_contact = response.data;
    //             })
    //             .catch((error) => {
    //                 console.log(error);
    //             });
    //     },
};
</script>
