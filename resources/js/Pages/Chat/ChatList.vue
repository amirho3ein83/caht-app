<script setup>
import ChatItem from "./ChatItem.vue";
import {useChatsStore} from "@/stores/Chats.js" 
import { ref } from "@vue/reactivity";
import { storeToRefs } from 'pinia'
import { gsap } from "gsap";

const store = useChatsStore()

store.getChats();


// const  chats = store.chats
// const { getChats } = useChatsStore()

// let chatTitle = (username) => {
//     props.chat.following = props.chat.name.replace(
//         username,
//         ""
//     );
//     return props.chat.following;
// };
const onEnter = (el, done)=> {
  gsap.to(el, {
    opacity: 1,
    height: '1.6em',
    delay: el.dataset.index * 0.15,
    onComplete: done
  })
}
</script>

<template>
        <div class="m-4" >

                <input
                @keypress="onEnter"
                    class=" rounded-2xl p-1 mb-4 w-96 text-lg text-gray-900 h-10 bg-gray-300 outline-none focus:bg-gray-200"
                    placeholder="           Search Contacts" />



            <div
                class=" flex flex-1 flex-end flex-col space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                <div id="messages"
                    class="flex flex-end h-100 flex-col-reverse space-y-4 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
                    <div>

<!-- <TransitionGroup
  tag="ul"
  :css="false"
  @before-enter="onBeforeEnter"
  @enter="onEnter"
  @leave="onLeave"
>

</TransitionGroup> -->

                            <ChatItem v-for="chat in store.chats" :key="chat.id" :chat="chat" />

                    </div>
                </div>
            </div>
        </div>
</template>
