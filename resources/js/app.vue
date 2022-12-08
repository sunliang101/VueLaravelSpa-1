<template>
  <v-app>
    <!-- サイドメニュー -->
    <v-navigation-drawer app clipped v-model="drawer" dark color="info">

      <v-list nav dense>
        <v-list-item-group>
          <v-list-item router :to="{ name: 'contents' }">
            <v-list-item-title>word</v-list-item-title>
          </v-list-item>

          <v-list-item router :to="{ name: 'cal' }">
            <v-list-item-title>cal</v-list-item-title>
             
          </v-list-item>

          <router-link v-bind:to="{name: 'cal'}">
                <button class="btn btn-success">Edit</button>
            </router-link>

        </v-list-item-group>
      </v-list>

    </v-navigation-drawer>

    <!-- ヘッダー -->
    <v-app-bar app clippedLeft flat dark color="indigo darken-3">
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-spacer></v-spacer>
    
      <v-text-field
            label=""
            single-line
            width="400px"
            class="shrink"
            v-model="cond"
            hide-details
            @keypress.enter="onKeypressEnter"
          ></v-text-field>

      <v-btn icon @click="onKeypressEnter">
        <v-icon>mdi-magnify</v-icon>
      </v-btn>
        <v-btn icon>
          <v-icon>mdi-heart</v-icon>
        </v-btn>
      <v-btn icon>
        <v-icon>mdi-dots-vertical</v-icon>
      </v-btn>
    </v-app-bar>

    <!-- メイン -->
    <v-main>
      <v-container fluid>
        <RouterView ref="view" ></RouterView>
      </v-container>
    </v-main>

    <!-- フッター -->
    <v-footer app color="primary">
    </v-footer>
  </v-app>
</template>

<script>

import header1 from "./components/HeaderComponent";
export default {
  name: 'app2',

  components: {
    // ここで子コンポーネント＆HTMLタグ名を登録
    header1: header1,
  },

  data() {
    return {
      drawer: false,
      cond: this.$route.query.type,
    }
  },

  watch: {
    $route(to, from) {
      //location.reload()
    }
  },

  mounted() {
      //  alert(123);
  },

  methods: {
      onKeypressEnter() {

        var p = {params: {
        "q":this.cond}}

        this.$refs.view.myMethod(p);
        // 同じページのへの遷移の場合、再描画されない

        //console.log(this.$route.name );
        //this.$router.push({ name: this.$route.name, params:{id:this.cond},query: { type: this.cond } })
      }
,

    }
}
</script>