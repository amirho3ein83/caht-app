import { defineStore } from "pinia";

export const useBioStore = defineStore('bio', {
    state: () => ({ socialMedia: {} }),

    actions: {
      getSocialMedia() {
        axios
            .get(route("user.socialMedia"))
            .then((response) => {
                console.log(response.data);
                this.socialMedia = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
    }
    },
  })