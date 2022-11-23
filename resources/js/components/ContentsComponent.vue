<template>
  <v-row>
    <v-col cols="12" sm="4" class="iphoneHidden">
      <v-sheet rounded="lg" min-height="50">

        <v-data-table id="vt" single-select :value="selected" :headers="headers" :items="tasks" :fixed-header="true"
          :footer-props="{
            'items-per-page-options': [10],
            'disable-items-per-page': true,
          }" class="elevation-1" height="70vh" @click:row="rowClick">
          <template v-slot:item.lvl="{ item }">

            <v-chip-group v-model="item.lvl" active-class="deep-purple--text text--accent-4" mandatory @change="ch">
              <v-chip v-for="(lv, i) in  [0, 1, 2, 9]" :key="i" :value="i" @click="ck(item)">
                {{ lv }}
              </v-chip>
            </v-chip-group>
          </template>
        </v-data-table>

      </v-sheet>
    </v-col>

    <v-col cols="12" sm="6">
      <v-sheet min-height="70vh" rounded="lg">
        <v-card class="mx-auto" max-width="400" height="76vh">
          <v-card-title>
            <h2 class="text-h4">
              {{ task.key }}
            </h2>
            <span class="text-h6 mx-sm-3">{{ task.read }}</span>
            <v-spacer></v-spacer>
            <v-chip>N</v-chip>
          </v-card-title>

          <v-card-text style="height: 335px;  max-height:340px;">
            <div class="pa-2 grey lighten-3 black--text rounded-lg"> {{ task.meaning }}</div>
            <v-list-item class="text-3 ma-0 pl-1" v-for="(item, i) in task.sample" :key="i">
              {{ i + 1 }}:{{ item }}
            </v-list-item>
          </v-card-text>

          <v-divider></v-divider>
          <v-card-actions>
            <v-row>
              <v-col md="6">

                <v-btn icon @click="btnNxt">
                  <v-icon>mdi-chevron-right</v-icon>
                </v-btn>

                <v-btn icon @click="btnclick">
                  <v-icon>{{ icn }}</v-icon>
                </v-btn>

                <v-btn icon @click="volclick">
                  <v-icon>{{ vol }}</v-icon>
                </v-btn>
              </v-col>
              <v-col md="6" class="ml-auto">
                <v-slider v-model="task.lvl" :tick-labels="ticksLabels" :max="3" step="1" ticks="always"
                  @change="lvlupd('range')" tick-size="4"></v-slider>
              </v-col>
            </v-row>

          </v-card-actions>
        </v-card>
        <!--  -->
      </v-sheet>
    </v-col>
  </v-row>

</template>
  
<script>
import { throws } from 'assert'
import { async } from 'q';

export default {
  props: {
    taskId: String
  },
  data: function () {
    return {
      ticksLabels: ["0", "1", "2", "9"],
      chipclk: {},
      selected: [],
      radios: [
        { id: 1, label: "l1" },
        { id: 2, label: "l2" },
      ],
      icn: "mdi-arrow-right-bold-circle-outline",
      vol: "mdi-volume-high",
      task: {},
      tasks: [],
      headers: [
        { text: "key", value: "key" },
        { text: "read", value: "read" },
        { text: "level", value: "lvl", width: 80 }
      ],
      currentid: 0,
    }
  },
  methods: {

    // Promiseを使う方法
    sleepByPromise: function (sec) {

      return new Promise(resolve => setTimeout(resolve, sec * 1000));

    },

    wait: async function (sec) {

      console.log('wait ' + sec.toString() + ' sec right now!');

      // await句を使って、Promiseの非同期処理が完了するまで待機します。
      await this.sleepByPromise(sec);

      console.log('wait ' + sec.toString() + ' sec done!');

    },


    ck() {
      console.log("ck");
      this.chipclk.ck = true;
    },
    ch() {
      console.log("ch");
      if (this.chipclk.ck) {
        this.chipclk.ch = true;
      }
    },
    volclick() {
      if (this.vol == "mdi-volume-high") {
        this.vol = "mdi-volume-mute";
      } else {
        this.vol = "mdi-volume-high";
      }
      // var wrapper = document.querySelector("#vt > div.v-data-table__wrapper")

      // wrapper.scrollTop = 55;


    },

    lvlupd(event) {
      console.log("lvlupd");
      if (this.chipclk.ch || event == "range") {
        axios.put('/api/contents/' + this.task.idreal, { "lvl": this.task.lvl })
          .then((res) => {
            console.log(res.data);
            this.chipclk.ck = false;
            this.chipclk.ch = false;
          });
      }
    },

    // 自動の切り替え
    btnclick() {

      if (this.icn == "mdi-arrow-right-bold-circle-outline") {
        this.icn = "mdi-pause-circle";
        
      }
      else {
        this.icn = "mdi-arrow-right-bold-circle-outline";
        return;
        
      }
      this.doLoop();


    }
    ,

    // 次へ
    btnNxt() {

      if (this.currentid >= this.tasks.length-1) {
        return;
      }
      this.currentid++;
      console.log("...."+this.currentid);
      this.task = this.tasks[this.currentid];

      this.selected = [this.tasks[this.currentid]];

      var wrapper = document.querySelector("#vt > div.v-data-table__wrapper");


      let wkIndex = this.currentid % 10;
      if (wkIndex == 0 && this.currentid >= 10) {
        wrapper.scrollTop = 0;
        document.querySelector("#vt > div.v-data-footer > div.v-data-footer__icons-after > button").click();
      }

      wrapper.scrollTop = (wkIndex - 6) * 55;
    }
    ,
    async doLoop() {
      if (this.icn == "mdi-pause-circle") {

        if (this.vol != "mdi-volume-high" ) {

          if (this.currentid >= this.tasks.length-1) {
            this.icn = "mdi-arrow-right-bold-circle-outline";
            return;
          }

          await this.sleepByPromise(2);
          this.btnNxt();
          this.doLoop();
        } else {
          // 発言を設定 (必須)
          const uttr = new SpeechSynthesisUtterance()

          // テキストを設定 (必須)
          uttr.text = this.task.read.replace(/(①|②|③|④|⑤|◎)/, '').replace(/(①|②|③|④|⑤|◎)/, '');

          // 言語を設定
          uttr.lang = "ja-JP"

          // //速度を設定
          // uttr.rate = 1

          // //高さを設定
          // uttr.pitch = 1

          // //音量を設定
          // uttr.volume = 1

          var th = this;

          if (this.currentid < this.tasks.length-1) {
            uttr.addEventListener('end', (event) => {
            
            th.btnNxt();
            th.doLoop();
            });
          } else {
            this.icn = "mdi-arrow-right-bold-circle-outline";
            //return;
          }

          
          //発言を再生 (必須)
          window.speechSynthesis.speak(uttr)
        }
      } else {
        return;
      }

    },

    getTasks() {
      axios.get('/api/contents')
        .then((res) => {
          this.tasks = res.data;
          console.log(this.tasks);
          this.task = this.tasks[0];
        });
    },

    updateL() {
      axios.put('/api/contents/1', { "lvl": this.task.lvl })
        .then((res) => {
          //this.$router.push({name: 'task.list'})
        });
    }
    ,
    // 第一引数にクリックした行のObjectが渡されるので処理を用意しておく
    rowClick(data, row) {
      console.log("rowClick");
      this.task = data;

      this.currentid = this.tasks.indexOf(this.task);

      row.select(true);
      if (this.chipclk.ch) {
        this.lvlupd();
      }
    },
  },
  mounted() {
    this.getTasks();
  }
}
</script>
<style>
.text-3 {
  color: #3d454c !important;
  font-size: 14px !important;
  min-height: 24px;

}

.small2 {
  height: 30px !important;
  font-size: 30px !important;
  width: 30px !important;
}

.v-slider__tick-label {
  font-size: 8px;
}


div.v-slide-group__wrapper>div>span {
  height: 15px !important;
  width: 15x !important;
  padding-left: 4px !important;
  padding-right: 4px !important;
  font-size: 9px !important;

}

.v-slide-group__content {
  width: 30px;
  display: flex;
  flex-wrap: wrap;
}

.v-chip--no-color {
  color: azure !important;
  background-color: aliceblue !important;
}

.v-data-table {
  white-space: nowrap;
}

@media only screen and (max-width: 450px) {
  .iphoneHidden {
    display: none !important;
  }


}
</style>
