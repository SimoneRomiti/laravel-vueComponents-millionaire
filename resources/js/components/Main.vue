<template>
  <main>
     <h3>Domanda da: {{ prize[level - 1] }}€</h3>

     <div class="box">
         <Question :gameQuestion="question" />
         <Answers :answers="question[0].answers" @correct="next" @error="end" :visible="visible"/>
         <Climb :level="level" :answers="question[0].answers" />
         <audio id="question" loop src="track/Question.mp3"></audio>

     </div>
     
     <div v-if="level > 1">
         <p v-if="prize.length == 1">Se abbandoni ora vinci 0€</p>
         <p v-else>Se abbandoni ora vinci {{ prize[level - 2] }}€</p>
         <p>Se sbagli porti a casa {{ error }}€</p>
         <button class="leave" @click="leave_game">Abbandona</button>
     </div>
    
  </main>
</template>

<script>
import Question from './Question.vue'
import Answers from './Answers.vue'
import Climb from './Climb.vue'
import 'jquery-confirm/js/jquery-confirm.js';

export default {
   name: 'Main',
   components: {
      Question,
      Answers,
      Climb
   },

   data(){
      return {
         level: 9,
         question: [],
         prize: [],
         error: 0,
         visible: [],

      }
   },

   mounted(){
      console.log(this.prize, 'PRIZE');
      this.next();
   },

   methods: {
      next(payload){         
         this.level++;
         if(this.level == 11 && payload.correct){
            this.win();
         } else {
            axios
            .get(`api/questions/${this.level}`)
            .then(response => {

               this.question = response.data;
               this.visible = [];
               
               document.getElementById('nextQuestion').play();
               setTimeout(function(){
                  document.getElementById('nextQuestion').pause();
                  document.getElementById('nextQuestion').currentTime = 0;
                  document.getElementById('question').play();
               }, 5500)

               console.log(this.question);
            })
         }
         
         switch(this.level){
            case 1:
               this.prize.push('1.000')
            break;
            case 2:
               this.prize.push('2.000')
            break;
            case 3:
               this.prize.push('5.000')
            break;
            case 4:
               this.prize.push('10.000')
               this.error = '5.000';
            break;
            case 5:
               this.prize.push('20.000')
            break;
            case 6:
               this.prize.push('50.000')
            break;
            case 7:
               this.prize.push('100.000')
               this.error = '50.000'
            break;
            case 8:
               this.prize.push('250.000')
            break;
            case 9:
               this.prize.push('500.000')
            break;
            case 10:
               this.prize.push('1 MILIONE')
            break;
         }

         console.log(this.level);

      },

      leave_game(){
         this.$confirm("Sicuro di voler abbandonare?").then(() => {
            this.$emit('leave', this.prize[this.level - 2]);
            
         })
      },

      end(){
         this.$emit('gameOver', this.error);
      },

      win(payload){
         this.$emit('millionaire');
      }
   }
}
</script>

<style lang="scss" scoped>
   main{
      height: 65vh;
      background: #11093A;
      text-align: center;
      color: white;
      padding: 20px;
      position: relative;

      
      .box{
         width: 55%;
         margin: auto;
      }

      ul{
         list-style: none;
      }

      h3{
         margin-bottom: 20px;
      }

      .leave{
         padding: 10px 15px;
         font-size: 20px;
         font-weight: bold;
         cursor: pointer;
         margin-top: 20px;
      }
   }
</style>