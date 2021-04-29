<template>
   <ul>
      <li v-for="answer, index in answers" :key="index" :class="{ chosen : on[index], success : correct[index], fail : error[index], real_correct: real[index] }" @click="clicked(index)" >
         <span :style="on[index] ? 'color:black' : ''">{{ answer.letter }}</span>

         <transition name="slide-fade">
            <p v-if="visible[index] && see[index]">{{ answer.option }}</p>
         </transition>
      </li>

      <div id="help">
         <span><strong>HELPS</strong></span>
         <button @click="help">50:50 <i v-if="counter == 0" class="fas fa-times"></i></button>
         <span>x{{ counter }}</span>
      </div>
      <img v-if="imageHappy" src="https://i.pinimg.com/originals/ec/92/ee/ec92ee1f3c77c8017295705224a0acef.png" alt="">
      <img v-if="imageSad" src="https://www.davidpuente.it/blog/wp-content/uploads/2014/08/gerry-scotti.jpg" alt="">
      <audio id="choose" src="track/Accendiamo.mp3"></audio>
      <audio id="right" src="track/Esatto2.mp3"></audio>
      <audio id="wrong" src="track/Sbagliato.mp3"></audio>
      
   </ul>
</template>

<script>
import 'jquery-confirm/js/jquery-confirm.js';
export default {
   name: 'Answers',
   props: ['answers', 'visible'],

   data(){
      return {
         on: [],
         correct: [],
         error: [],
         once: 0,
         imageHappy: false,
         imageSad: false,
         greenAnswerIndex: '',
         real: [],
         wrongs: [],
         see: [true, true, true, true],
         counter: 3,
         helpQuestion: 0
      }
   },

   mounted(){
      this.firstTimeAppear();
   },

   watch: {
      answers: function(){
         this.othersAppear();
      }
   },

   methods: {
      clicked(i){
         if(this.once == 0){
            this.$confirm("Accendiamo la " + this.answers[i].letter + '?').then(() => {
               const self = this;
               self.once = 1;
               
               document.getElementById('nextQuestion').pause();
               document.getElementById('nextQuestion').currentTime = 0;
               document.getElementById('question').pause();
               document.getElementById('question').currentTime = 0;
               document.getElementById("choose").play();

               self.on[i] = true;
               console.log(self.on);
               this.$forceUpdate();

               setTimeout(function(){
                  if(self.answers[i].correct){
                     
                     self.on[i] = false;
                     self.correct[i] = true;
                     self.imageHappy = true;
                     console.log(self.correct, 'CORRECT');
                     document.getElementById("choose").pause();
                     document.getElementById("choose").currentTime = 0;

                     document.getElementById("right").play();
                     self.$forceUpdate();

                     setTimeout(function(){
                        self.$emit('correct');
                        
                        setTimeout(function(){
                           self.on = [];
                           self.correct = [];
                        }, 250)
                        
                        self.imageHappy = false;
                        setTimeout(function(){
                           self.see = [true, true, true, true];
                           self.helpQuestion = 0;
                        }, 500)


                     }, 8000)


                  } else{
                     document.getElementById("choose").muted = true;
                     document.getElementById("wrong").play();
                     self.imageSad = true;
                     self.on[i] = false;
                     self.error[i] = true;

                     self.answers.forEach((element, index) => {
                        if(element.correct == 1){
                           i = index;
                           self.real[i] = true;
                        }
                     })
                     self.$forceUpdate();
                     console.log(self.correct);


                     setTimeout(function(){
                        self.$emit('error');
                        
                        setTimeout(function(){
                           self.on = [];
                           self.error = [];
                        }, 250)
                        
                        self.imageSad = false;

                     }, 4000)
                  }
                  
                  self.once = 0;

               }, 5000)
            });
            
              
            
         }   
      },

      firstTimeAppear(){
         const self = this;
         console.log('OK');
         var i = 0;
         setTimeout(function(){
         var interval = setInterval(function(){
            if(i == 4){
               clearInterval(interval);
            } else {
                  self.visible.push(true);
                  i++;
            }
            
         }, 1000)
         
         }, 5000)
         self.i = 0;
      },

      othersAppear(){
         const self = this;
         var i = 0;
         setTimeout(function(){
         var interval = setInterval(function(){
            if(i == 4){
               clearInterval(interval);
            } else {
                  self.visible.push(true);
                  i++;
            }
            
         }, 1000)
         
         }, 5000)
      },

      help(){
         if(this.helpQuestion == 0 && this.counter > 0){
            this.$confirm(`Sei sicuro di voler utilizzare l'aiuto? Ne hai ancora ${this.counter} a disposizione`).then(() => {
               this.helpQuestion = 1;
               this.counter--;
               this.wrongs = [];
               this.answers.forEach(element => {
                  if(element.correct == 0){
                     this.wrongs.push(element);
                  }
               })

               for(var j = 0; j < 2; j++){
                  var i = Math.floor((Math.random() * this.wrongs.length));
                  console.log(i);
                  var cancel = this.wrongs[i];
                  this.answers.forEach((element, key) => {
                     if(element == cancel){
                        this.see[key] = false;
                        this.wrongs.splice(i, 1);
                        this.$forceUpdate();
                     }
                  })
                  console.log(this.see, 'SEE');
                  console.log(this.wrongs, 'WRONGS');
               }
            })
            
         }
         
         
      }
   } 
}

</script>

<style lang="scss" scoped>
   ul{
      color: white;
      display: flex;
      justify-content: flex-start;
      flex-wrap: wrap;
      position: relative;
      margin-top: 25px;

      .chosen{
         background: yellow;
         color: black;
      }

      .success{
         background: green;
         animation-name: blinking;
         animation-duration: 1s;
      }

      @keyframes blinking {
         0%{
            background: green;
         }
         10%{
            background: yellow
         }
         20%{
            background: green;
         }
         30%{
            background: yellow
         }
         40%{
            background: green;
         }
         50%{
            background: yellow
         }
         60%{
            background: green;
         }
         70%{
            background: yellow
         }
         80%{
            background: green;
         }
         90%{
            background: yellow
         }
         100%{
            background: green;
         }
      }

      .fail{
         background: red;
         animation-name: blinking_failed;
         animation-duration: 1s;
      }

      @keyframes blinking_failed {
         0%{
            background: red;
         }
         10%{
            background: yellow
         }
         20%{
            background: red;
         }
         30%{
            background: yellow
         }
         40%{
            background: red;
         }
         50%{
            background: yellow
         }
         60%{
            background: red;
         }
         70%{
            background: yellow
         }
         80%{
            background: red;
         }
         90%{
            background: yellow
         }
         100%{
            background: red;
         }
      }

      .real_correct{
         background: green;
         animation-name: blinking_real;
         animation-duration: 1s;
      }

      @keyframes blinking_real {
         0%{
            background: green;
         }
         10%{
            background: transparent
         }
         20%{
            background: green;
         }
         30%{
            background: transparent
         }
         40%{
            background: green;
         }
         50%{
            background: transparent
         }
         60%{
            background: green;
         }
         70%{
            background: transparent
         }
         80%{
            background: green;
         }
         90%{
            background: transparent
         }
         100%{
            background: green;
         }
      }

      img{
         width: 200px;
         height: 200px;
         border-radius: 50%;
         position: absolute;
         top: -158%;
         left: 50%;
         transform: translateX(-50%);
      }

      li{
         width: calc(100% / 2 - 100px);
         margin: 25px 50px;
         border: 1px solid white;
         // padding: 20px 0;
         height: 70px;
         display: flex;
         align-items: center;
         justify-content: center;
         position: relative;

         &:hover{
            cursor: pointer;
         }

         span{
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-weight: 700;
            color: yellow;
         }

      }

      #help{
         position: absolute;
         left: -36.5%;
         top: -150%;
         width: 280px;
         border: 1px solid white;
         background: #11093A;
         padding: 10px 0;
         
         button{
            margin: 0 10px;
            padding: 10px 15px;
            background: blue;
            color: white;
            font-weight: bold;
            position: relative;

            &:hover{
               cursor: pointer;
            }

            .fas{
               color: red;
               position: absolute;
               top: 50%;
               left: 50%;
               transform: translate(-50%, -50%);
               font-size: 40px;
            }
         }
      }

      .slide-fade-enter-active {
         transition: all .8s ease;
      }
      .slide-fade-leave-active {
         transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
      }
      .slide-fade-enter, .slide-fade-leave-to
         /* .slide-fade-leave-active below version 2.1.8 */ {
         transform: translateX(-30px);
         opacity: 0;
      }
   }
</style>