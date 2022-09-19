export const useFollowersStore = defineStore('counter', {
    state: () => ({ chats: {}, name: '' }),
    getters: {
    //   doubleCount: (state) => state.count * 2,
    },
    actions: {
      increment() {
        // this.count++
      },
    },
  })