<template>
    
    <div class="container">


        <div class="">
            <v-app>
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
        <div class="pa-2 grey lighten-3 black--text rounded-lg">带日期。把制作、提交的年月日写在文件等上面，亦指写上去的年月日。（文書などに，作成・提出の年月日を記すこと。また，その年月日。）</div> 
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
        :tick-labels="seasons"
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


</v-app>

            <div class="col-sm-6">
                <form>
                    <div class="form-group row border-bottom">
                        <label for="id" class="col-sm-3 col-form-label">ID</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="id"
                               v-model="task.id">
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="title" class="col-sm-3 col-form-label">Title</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="title"
                               v-model="task.title">
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="content" class="col-sm-3 col-form-label">Content</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="content"
                               v-model="task.content">
                    </div>
                    <div class="form-group row border-bottom">
                        <label for="person-in-charge" class="col-sm-3 col-form-label">Person In Charge2</label>
                        <input type="text" class="col-sm-9 form-control-plaintext" readonly id="person-in-charge"
                               v-model="task.person_in_charge">
                    </div>
                </form>

                <v-chip
                    class="ma-1"
                    close
                    color="red"
                    label
                    outlined
                >
                    Complete
                 </v-chip>


<v-card
  elevation="2"
  outlined
  shaped
></v-card>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            taskId: String
        },
        data: function () {
            return {
                task: {}
            }
        },
        methods: {
            getTask() {
                axios.get('/api/tasks/' + this.taskId)
                    .then((res) => {
                        console.log(res);
                        this.task = res.data;
                    });
            }
        },
        mounted() {
            this.getTask();
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
