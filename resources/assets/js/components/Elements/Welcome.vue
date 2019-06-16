<template>
    <div class="my-2">
        <div class="w-full flex justify-center items-center">
            <img class="no-drag" width="175" alt="Laravel Prequel" src="/vendor/prequel/favicon.png">
        </div>
        <h1 class="text-center text-gray-900 font-semibold text-2xl mt-2">
            Welcome to Laravel Prequel!
        </h1>
        <div class="flex justify-center my-2">
            <a href="https://protoqol.github.io/Prequel"
               target="_blank"
               class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-4 rounded-full mx-1">
                Docs
            </a>
            <a href="https://github.com/Protoqol/Prequel/issues/new"
               target="_blank"
               class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-4 rounded-full mx-1">
                Bug report
            </a>
            <a href="https://github.com/Protoqol/Prequel"
               target="_blank"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded-full mx-1">
                Github
            </a>
        </div>
    </div>
</template>

<script>
  export default {
    name: 'Welcome',
  };
</script>
