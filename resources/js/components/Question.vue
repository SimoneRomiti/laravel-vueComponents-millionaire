<template>
  <div>
     <p>{{ gameQuestion[0].question }}</p>    
  </div>
</template>

<script>
export default {
   name: 'Question',
   props: ['gameQuestion']
}
</script>

<style lang="scss" scoped>
   div{
      color: white;
      border-top: 1px solid white;
      border-bottom: 1px solid white;
      padding: 20px;

   }
</style>