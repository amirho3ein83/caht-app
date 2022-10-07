<script setup>

const deleteNotification = ()=>{
    
}
</script>

<template>

<div id="toast-notification" class="w-[420px]  p-2 text-gray-900 bg-gray-300 rounded-lg shadow dark:bg-gray-800 dark:text-gray-300" role="alert">

    <div class="flex items-center justify-between">
            <img class="w-14 h-14 object-cover rounded-full" :src="$page.props.user.profile" alt="Jese Leos image">
        <div class="ml-3 text-sm font-normal">
            <div class="text-sm font-semibold text-gray-900 dark:text-white">Bonnie Green</div>
            <div class="text-sm font-normal">commmented on your photo</div> 
        </div>
        <div class="flex flex-col self-center items-end">

            <svg @click="deleteNotification" aria-hidden="true" class="w-5 h-5 mb-3 text-red-500 hover:scale-110 transition-all duration-150 ease-linear" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="text-sm justify-end font-medium text-blue-600 dark:text-blue-500 ">a few seconds ago</span>   
           
        </div>
    </div>
</div>

</template>
