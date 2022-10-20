import { Inertia } from "@inertiajs/inertia";
import { defineStore } from "pinia";

export const useProfileStore = defineStore("profile", {
    state: () => ({
        profile: {},
        bio: "",
        instagram: "",
        telegram: "",
        followers_count: 0,
        followings_count: 0,
    }),

    actions: {
        // showUserProfile(id) {
        //     axios
        //         .get(route("profile", { user: id }))
        //         .then((res) => {
        //             // console.log(res.data);
        //             this.profile = res.data;
        //             // this.bio = res.data.social_media.bio;
        //             this.followers_count = res.data.followers_count;
        //             this.followings_count = res.data.followings_count;
        //             this.instagram = res.data.instagram;
        //             this.telegram = res.data.telegram;
        //         })
        //         .catch((error) => {
        //             console.log(error);
        //         });
        // },
        showUserProfile(id) {
            Inertia.get(
                route("profile", { id: id }),
                {},
                {
                    preserveState: true,
                    onSuccess: (res) => {
                        console.log(res.data);
                        this.profile = res.data;
                        this.bio = res.data.social_media.bio;
                        this.followers_count = res.data.followers_count;
                        this.followings_count = res.data.followings_count;
                        this.instagram = res.data.instagram;
                        this.telegram = res.data.telegram;
                    },
                    onError(error){
                    console.log(error);

                    }
                }
            );
        },
    },
});
