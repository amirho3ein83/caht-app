import { Inertia } from "@inertiajs/inertia";
import axios from "axios";
import { defineStore } from "pinia";

export const useChatsStore = defineStore("chats", {
    state: () => ({ chats: [] }),
    getters: {
        //   doubleCount: (state) => state.count * 2,
    },
    actions: {
        async getChats() {
            try {
                const data = await axios.get(
                    "chats"
                );
                this.chats = data.data;
                console.log(this.chats)
            } catch (error) {
                alert(error);
                console.log(error);
            }
        },
    },
});
