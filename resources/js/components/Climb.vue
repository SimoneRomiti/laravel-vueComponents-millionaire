<template>
  <ul>
     <li id="last" :class="level == 10 ? 'active' : level > 10 ? 'success' : ''">1 MILIONE</li>
     <li id="ninth" :class="level == 9 ? 'active' : level > 9 ? 'success' : ''">500.000€</li>
     <li id="eighth" :class="level == 8 ? 'active' : level > 8 ? 'success' : ''">250.000€</li>
     <li id="seventh" :class="level == 7 ? 'active' : level > 7 ? 'success' : ''">100.000€</li>
     <li id="sixth" :class="level == 6 ? 'active' : level > 6 ? 'success' : ''"><span>*</span> 50.000€</li>
     <li id="fifth" :class="level == 5 ? 'active' : level > 5 ? 'success' : ''">20.000€</li>
     <li id="fourth" :class="level == 4 ? 'active' : level > 4 ? 'success' : ''">10.000€</li>
     <li id="third" :class="level == 3 ? 'active' : level > 3 ? 'success' : ''"><span>*</span> 5.000€</li>
     <li id="second" :class="level == 2 ? 'active' : level > 2 ? 'success' : ''">2.000€</li>
     <li id="first" :class="level == 1 ? 'active' : level > 1 ? 'success' : ''">1.000€</li>
  </ul>
</template>

<script>
export default {
  name: 'Climb',
  props: ['level'],

  mounted(){
    console.log(this.level, 'LEVEL');
  }

}
</script>

<style lang="scss" scoped>
  ul{
    position: absolute;
    left: 60px;
    top: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;

    li{
      padding: 10px 0;
      border: 1px solid white;
      position: relative;
      
      &#first{
        width: 100px;
      }
      &#second{
        width: 120px;
      }
      &#third{
        width: 140px;
      }
      &#fourth{
        width: 160px;
      }
      &#fifth{
        width: 180px;
      }
      &#sixth{
        width: 200px;
      }
      &#seventh{
        width: 220px;
      }
      &#eighth{
        width: 240px;
      }
      &#ninth{
        width: 260px;
      }
      &#last{
        width: 280px;
      }

      &.active{
        background: yellow;
        color: black;
        animation-name: blinking;
        animation-duration: 1s;
      }

      @keyframes blinking {
         0%{
            background: yellow;
         }
         10%{
            background: none
         }
         20%{
            background: yellow;
         }
         30%{
            background: none
         }
         40%{
            background: yellow;
         }
         50%{
            background: none
         }
         60%{
            background: yellow;
         }
         70%{
            background: none
         }
         80%{
            background: yellow;
         }
         90%{
            background: none
         }
         100%{
            background: yellow;
         }
      }

      &.success{
        background: green;
      }

      span{
        position: absolute;
        left: 15px;
        top: 50%;
        height: 10px;
        transform: translateY(-50%);
      }
    }
  }
</style>