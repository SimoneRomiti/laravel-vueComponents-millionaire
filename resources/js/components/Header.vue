<template>
   <header>
      <h1>Who wants to be a millionaire</h1>
      <img :src="img" alt="">
   </header>
</template>

<script>
export default {
   name: 'Header',
   props: ['img', 'start', 'volume'],

   data(){
      return {
         on: true
      }
   },

   methods: {
     
   }
}
</script>

<style lang="scss" scoped>
   header{
      height: 35vh;
      background: #0E0F8A;
      padding: 20px 0;
      display: flex;
      flex-direction: column;
      align-items: center;

      h1{
         text-align: center;
         color: white;
      }

      img{
         width: 12%;
      }

      .fas{
         // position: absolute;
         // top: -30%;
         // left: 100px;
         font-size: 25px;
         color: white;
         cursor: pointer;
      }
   }
</style>