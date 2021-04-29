<template>
   <div box_container>
      <div v-if="gameOver == false">
         <Header img="img/logo.png" :start="start" :volume="volume" />

         <div class="initial_main" v-if="start == false">
            <button class="button" @click="autoplay">Ready to play!</button>
         </div>
         

         <div v-if="start && giveup == false">
            <Main @gameOver="endGame" @leave="giveup_function" @millionaire="win_function" />
         </div>      

         <audio id="nextQuestion" muted src="track/NextQuestion.mp3"></audio>
      </div>

      <div class="end" v-if="gameOver && victory == false">
         <Header img="img/logo.png" :start="start" :volume="volume" />
         <div class="ending">
            <h1 id="over">GAME OVER</h1>
            <img src="https://www.chedonna.it/wp-content/uploads/2018/11/gerry-scotti1.jpg" alt="">
            <h1>You win {{ moneyError }}€</h1>
         </div>
         
      </div>

       <div v-if="gameOver && victory">
         <Header img="img/logo.png" :start="start" :volume="volume" />

         <h1 class="animate__animated animate__backInLeft">YOU WIN</h1>
         <div v-if="image" class="box_img animate__animated animate__zoomIn">
            <img class="first" src="https://previews.123rf.com/images/juliarstudio/juliarstudio1603/juliarstudio160301925/53975798-icona-della-corona-di-alloro-in-stile-fumetto-isolato-su-priorit%C3%A0-bassa-bianca-corona-di-alloro-verde-.jpg" alt="">
         </div>
         
         <h1 class="million">1 MILIONE</h1>
         <audio id="winning" src="track/Win.mp3"></audio>

      </div>

      <div class="leave" v-if="giveup">
          <div class="ending">
            <h1>You left the game, you win {{ moneyLeave }}€</h1>
         </div>
      </div>

      <div v-if="gameOver || giveup" class="button_container">
         <button class="new_game" @click="startNewGame">Start new game</button>
      </div>
      
   </div>
</template>

<script>
import Header from './components/Header.vue';
import Main from './components/Main.vue'
export default {
   name: 'App',
   components:{
     Header,
     Main
   },

   data(){
      return {
         gameOver: false,
         start: false,
         giveup: false,
         moneyLeave: 0,
         moneyError: 0,
         volume: true,
         victory: false,
         image: false
      }
   },

   methods: {
      endGame(payload){
         this.gameOver = true;
         this.moneyError = payload;
         console.log(this.gameOver);
      },

      giveup_function(payload){
         this.giveup = true;
         this.moneyLeave = payload;

      },

      autoplay(){
         document.getElementById("nextQuestion").play();
         document.getElementById('nextQuestion').muted = false;
         this.start = true;
      },

      startNewGame(){
         this.start = false;
         this.giveup = false;
         this.gameOver = false;
      },

      win_function(){
         const self = this;
         this.victory = true;
         this.gameOver = true;
        
        setTimeout(function(){
            document.getElementById('winning').play();
        }, 500)

         setTimeout(function() {
            self.image = true;
         }, 2000)
      }
   }

}
</script>

<style lang="scss" scoped>

   .box_container{
      position: relative;
     
   }

   .initial_main{
      position: relative;
      height: 60vh;

      .button{
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         padding: 20px 25px;
         font-size: 30px;
         font-weight: bold;
         background: #0E0F8A;
         color: white;
         cursor: pointer;

         &:hover{
            background: blue;
         }
         
      }
   }

   .button_container{
      width: 40%;
      margin: 20px auto;
      text-align: center;

      .new_game{
      padding: 20px 25px;
      font-size: 30px;
      font-weight: bold;
      background: #0E0F8A;
      color: white;
      cursor: pointer;

         &:hover{
            background: blue;
         }
      }
   }
   
   
   .ending{
      width: 60%;
      margin: auto;
      text-align: center;
       h2{
         padding: 20px 0 0;
         text-align: center;
      }

      h1{
         text-align: center;
         margin: 40px 0;
      }

      img{
         width: 40%;
      }

   }

   .million{
      font-size: 50px;
      text-align: center;
   }

   h1{
      text-align: center;
   }

   img.first{
      width: 15%;
   }

   .box_img{
      text-align: center;
   }

   #over{
      text-align: center;
      padding: 20px 0;
      margin: 0;
   }
  
   
</style>