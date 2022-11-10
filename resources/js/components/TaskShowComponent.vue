<template>
          <v-row>
            <v-col
              cols="12"
              sm="2"
            >
              <v-sheet
                rounded="lg"
                min-height="268"
              >
              123
                <!--  -->
              </v-sheet>
            </v-col>
  
            <v-col
              cols="12"
              sm="6"
            >
              <v-sheet
                min-height="70vh"
                rounded="lg"
              >
              <v-card
    class="mx-auto"
    max-width="400"
  >
    <v-card-title>
      <h2 class="text-h4">
        日付1
      </h2>
      <span class="text-h6 mx-sm-3">[ひづけ]◎</span>
      <v-spacer></v-spacer>
      <v-chip >N</v-chip>
    </v-card-title>

    <v-card-text>
        <div class="pa-2 grey lighten-3 black--text rounded-lg"> {{ task.title }}</div> 
    </v-card-text>

    <v-list-item class="text-3">
        带日期。把制作、提交的年月日写在文件等上面，亦指写上去的年月日。（文書などに，作成・提出の年月日を記すこと。また，その年月日。）
    </v-list-item>
    <v-list-item style="margin-top: 4px;" class="text-3">
        带日期。把制作、提交的年月日写在文件等上面，亦指写上去的年月日。（文書などに，作成・提出の年月日を記すこと。また，その年月日。）
    </v-list-item>
       <v-card-actions>
       

    <v-row>
        <v-col cols="3">
            <v-btn class="ma-2 small2" outlined fab  color="grey">
        <v-icon>mdi-arrow-right-bold</v-icon>
        </v-btn>
        </v-col>    
    <v-col cols="9" class="pa-4">
      <v-range-slider
        :value="[0, 1]"
        min="0"
        max="3"
        ticks="always"
        tick-size="4"
      >
        
      </v-range-slider>
    </v-col>
  </v-row>

    </v-card-actions>
  </v-card>
                <!--  -->
              </v-sheet>
            </v-col>
  
            <v-col
              cols="12"
              sm="4"
            >
              <v-sheet
                rounded="lg"
                min-height="50"
              >

              <v-data-table
                :headers="headers"
                :items="tasks"
                :footer-props="{
                    'items-per-page-options':[10],
                    'disable-items-per-page': true,
                }"
                class="elevation-1"
                height="70vh"
                @click:row="rowClick" 
            >
            <template #[`item.id`]="{ item }">
                <v-radio-group row v-model="item.id"> <!-- 各行でラジオボタンをグループ化 -->
                <v-layout row justify-center> <!-- ラジオボタンを横1行で表示する -->
                    <v-radio
                    v-for="r in radios"
                    :key="r.id"
                    :label="r.label"
                    :value="r.id"
                    class="my-0 mr-4"
                    />
                </v-layout>
                </v-radio-group>
            </template>
        </v-data-table>

              </v-sheet>
            </v-col>
          </v-row>

  </template>
  
  <script>
  export default {
      props: {
          taskId: String
      },
      data: function () {
          return {
            radios: [
                { id: 1, label: "l1" },
                { id: 2, label: "l2" },
            ],
              task: {},
              tasks: [],
              headers : [
                { text: "id", value: "id" },
                { text: "Fat (g)", value: "content" }
                ],
          }
      },
      methods: {
          getTask() {
              axios.get('/api/tasks/' + this.taskId)
                  .then((res) => {
                      console.log(res);
                      this.task = res.data;
                  });
          },

          getTasks() {
                axios.get('/api/tasks')
                    .then((res) => {
                        this.tasks = res.data;
                        console.log(tasks);
                    });
            },
        // 第一引数にクリックした行のObjectが渡されるので処理を用意しておく
        rowClick(data,  row) {
            this.task= data;
        },
      },
      mounted() {
          this.getTask();
          this.getTasks();
      }
  }
</script>
  <style>

  .text-3 {
      color: #3d454c !important;
      font-size: 14px !important;

  }

  .small2{
  height: 30px !important;
  font-size: 30px !important;
  width: 30px !important;
}

</style>
