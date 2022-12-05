<template>
<v-row>
<v-col ><iframe src="https://calendar.google.com/calendar/embed?src=265d26f5728fee4bb40dea01f06530925baedc49db837f9796f13634a0fe4f75%40group.calendar.google.com&ctz=Asia%2FTokyo" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
</v-col>
<v-col col="4" class="wordcard" tabIndex="0">
  <v-card class="mx-auto v-card--flat pa-2" max-width="344">
    <v-card-text>
      <v-badge left overlap v-bind:color="ors[content.lvl]" :content="content.lvl" :value="content.lvl"></v-badge>
      <v-row>
        <v-col lg="9" class="pa-3 pl-5"><span class="text-h6">{{ content.key  }}</span> &nbsp; <span v-if="pron" class="grey--text text--accent-2">{{ content.read  }}</span>
        </v-col>
        <V-spacer></V-spacer>
        <v-col lg="3" class="d-flex pa-1">
          <v-badge left overlap offset-x="10" color="grey lighten-5"   class="nownav" v-bind:content="nowIndex +1 +'/' + contents.length"></v-badge>
          <v-btn icon @click="nxtfun">
            
            <v-icon>{{ stopFlg ? "mdi-chevron-right" : "mdi-stop" }}</v-icon>
          </v-btn>

          <div class="text-center">
            <v-menu v-model="menu" :close-on-content-click="false" :nudge-width="200" offset-x>
              <template v-slot:activator="{ on, attrs }">
                <v-btn icon v-bind="attrs" v-on="on">
                  <v-icon>mdi-dots-vertical</v-icon>
                </v-btn>
              </template>

              <v-card>
                <v-list>
                  <v-list-item>
                    <v-list-item-action>
                      <v-switch v-model="loop" color="purple"></v-switch>
                    </v-list-item-action>
                    <v-list-item-title>loop</v-list-item-title>
                  </v-list-item>
                  <v-list-item>
                    <v-list-item-action>
                      <v-switch v-model="sound" color="purple"></v-switch>
                    </v-list-item-action>
                    <v-list-item-title>sound</v-list-item-title>
                  </v-list-item>
                  <v-list-item>
                    <v-list-item-action>
                      <v-switch v-model="pron" color="purple"></v-switch>
                    </v-list-item-action>
                    <v-list-item-title>pronunciation</v-list-item-title>
                  </v-list-item>
                </v-list>
              </v-card>
            </v-menu>
          </div>
        </v-col>
      </v-row>

    </v-card-text>
    <v-card-text v-if="showdetail">
        <div class="pa-2 grey lighten-3 black--text rounded-lg"> {{ content.meaning }}</div>
        <v-list-item class="text-3 ma-0 pl-1" v-for="(item, i) in content.sample" :key="i">
          {{ i + 1 }}:{{ item }}
        </v-list-item>


    </v-card-text>
  </v-card>
</v-col>

</v-row>

</template>
  
<script>
import { throws } from 'assert'
import { timingSafeEqual } from 'crypto';

export default {
  data: function () {
    return {
      reveal: false,
      fav: true,
      menu: false,
      loop: false,
      sound: true,
      pron: true,
      stopFlg: true,
      nowIndex: 0,
      maxCnt: 0,
      lvl: 2,
      contents: [],
      content: {},
      showdetail:false,
      colors:{0: "grey", 1: "blue", 2: "green", 3: "red"},
      ors:["grey",  "green",  "blue",  "red"],
      preFlg:false,
    }
  },
  methods: {

    // Promiseを使う方法
    sleepByPromise: function (sec) {

      return new Promise(resolve => setTimeout(resolve, sec * 1000));

    },

    nxtfun() {
      console.log(this.loop);

      if (this.loop) {

        // loop
        this.stopFlg = !this.stopFlg;

        // soundがある場合
        if (this.sound) {
          this.doSoundLoop(true);
        } else {

          //　自分にループにする。
          this.doLoop();
        }



      } else {

        // go to next
        this.doSoundLoop(false);

      }
    }
    ,
    doSoundLoop(loopFlg) {

      if (!loopFlg) {
        this.moveNext(1);
      }

      if (this.sound) {

        // 発言を設定 (必須)
        const uttr = new SpeechSynthesisUtterance()

        // テキストを設定 (必須)
        uttr.text = this.content.read.replace(/(①|②|③|④|⑤|◎)/, '').replace(/(①|②|③|④|⑤|◎)/, '');

        // 言語を設定
        uttr.lang = "ja-JP"

        // //速度を設定
        // uttr.rate = 1

        // //高さを設定
        // uttr.pitch = 1

        // //音量を設定
        // uttr.volume = 1
        console.log(this.nowIndex);
        var th = this;

        console.log(loopFlg);
        if (loopFlg) {
          uttr.addEventListener('end', (event) => {

            if (!th.moveNext()) {
              return;
            }
            th.doSoundLoop(true);
          });
        }

        //発言を再生 (必須)
        window.speechSynthesis.speak(uttr)

      }



    }
    ,

    async doLoop() {
      console.log("doLoop" + this.nowIndex);
      if (!this.moveNext()) {
        return;
      }


      await this.sleepByPromise(2);
      this.doLoop();
    }
    ,
    moveNext(step) {

      if (this.stopFlg == true && step !==1 ) {
        return false;
      }
      console.log("moveNext" + this.nowIndex);

      if (this.preFlg) {
        this.nowIndex--;
        this.preFlg = false;
      } else {
        this.nowIndex++;
      }
      
      if (this.nowIndex > this.contents.length - 1) {
        this.stopFlg = true;
        console.log(this.stopFlg);
        this.nowIndex--;
        return false;
      } else if (this.nowIndex < 0){
        this.nowIndex++;
        return false;
      }


      this.content = this.contents[this.nowIndex];

      return true;

    }

    ,
    myMethod(p){
      this.getCotents(p);
    }

    ,
    onKeyDown(event) {
      console.log(event);
      console.log(event.key);
      
      if (event.keyCode === 32) {
        //this.stopFlg = !this.stopFlg;
        //if (this.stopFlg === false) {
          this.nxtfun();
        //}
      } else if ( event.key >= 0 && event.key <=3 ) {
        this.content.lvl = event.key;
        this.lvlupd();
      } else if (event.keyCode === 17) {
        this.showdetail = !this.showdetail;
      } else if (event.keyCode === 39 || event.keyCode === 40) {
        this.doLoop = false;
        this.nxtfun();
      } else if (event.keyCode === 37 || event.keyCode === 38) {
        this.doLoop = false;
        this.preFlg = true;
        this.nxtfun();
      }
      

    }
    ,
    getCotents(p) {
      console.log(p);
      axios.get('/api/contents', p)
        .then((res) => {
          this.contents = res.data;
          this.nowIndex = 0;
          this.content = this.contents[this.nowIndex];
        });
    },

    lvlupd() {
      console.log("lvlupd");
        axios.put('/api/contents/' + this.content.idreal, { "lvl": this.content.lvl })
          .then((res) => {
            console.log(res.data);
          });
      }


  },
  mounted() {
    // this.content = this.contents[this.nowIndex];
    this.getCotents({});
//    document.addEventListener('keydown', this.onKeyDown)

document.querySelector("#app > div > main > div > div > div > div.wordcard.col").addEventListener('keydown', this.onKeyDown);
  }

}
</script>
<style>
.v-card--reveal {
  bottom: 0;
  opacity: 1 !important;
  position: absolute;
  width: 100%;
}

.nownav > span > span 
{
 color: grey !important;
}

.wordcard {
  outline: none;
}

</style>

