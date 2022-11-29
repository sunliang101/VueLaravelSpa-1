<template>
<v-row>
<v-col ><iframe src="https://calendar.google.com/calendar/embed?src=265d26f5728fee4bb40dea01f06530925baedc49db837f9796f13634a0fe4f75%40group.calendar.google.com&ctz=Asia%2FTokyo" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>
</v-col>
<v-col col="4">
  <v-card class="mx-auto v-card--flat pa-2" max-width="344">
    <v-card-text>
      <v-badge left overlap v-bind:color="ors[content.lvl]" :content="content.lvl" :value="content.lvl"></v-badge>
      <v-row>
        <v-col class="pa-3 pl-5">{{ content.key }}


        </v-col>
        <V-spacer></V-spacer>
        <v-col lg="3" class="d-flex pa-1">

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
      难得 (nándé), 罕有地 (hǎnyǒu de)
      （打消しの語を伴って）非常に頻度の少ないさま。

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
      contents: [{ key: "めったに", lvl: 1 }, { key: "テスト２", lvl: 2 }, { key: "テスト３", lvl: 3 }, { key: "テスト4", lvl: 3 }, { key: "テスト5", lvl: 3 }, { key: "テスト6", lvl: 3 }],
      content: {},
      showdetail:false,
      colors:{0: "grey", 1: "blue", 2: "green", 3: "red"},
      ors:["grey",  "green",  "blue",  "red"],


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
        uttr.text = this.content.key.replace(/(①|②|③|④|⑤|◎)/, '').replace(/(①|②|③|④|⑤|◎)/, '');

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
      this.nowIndex++;
      if (this.nowIndex > this.contents.length - 1) {
        this.stopFlg = true;
        console.log(this.stopFlg);
        this.nowIndex--;
        return false;
      }
      this.content = this.contents[this.nowIndex];

      return true;

    }

    ,
    onKeyDown(event) {
      console.log(event.keyCode);
      console.log(event.key);
      
      if (event.keyCode === 32) {
        //this.stopFlg = !this.stopFlg;
        //if (this.stopFlg === false) {
          this.nxtfun();
        //}
      } else if ( event.key >= 0 && event.key <=3 ) {
        this.content.lvl = event.key;
      } else if (event.keyCode === 17) {
        this.showdetail = !this.showdetail;
      }
      

    }

  },
  mounted() {
    this.content = this.contents[this.nowIndex];
    document.addEventListener('keydown', this.onKeyDown)
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
</style>

