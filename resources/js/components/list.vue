<template>
    <v-container style="max-width:100%;">
        <v-row class="cond">
            <v-col cols="2">
                <v-text-field v-model="forms.textbox" label="名前" hide-details></v-text-field>
            </v-col>
            <v-col cols="2">
                <v-select hide-details v-model="forms.select" label="所属" :items="constant.SELECTS" item-text=name
                    item-value=id></v-select>
            </v-col>
            <v-col cols="2">
                <v-text-field v-model="inputDate" type="date" label="入社日－開始" hide-details />
            </v-col>
            <v-col cols="2">
                <v-text-field v-model="inputDate" type="date" label="入社日－終了" hide-details />

            </v-col>
            <v-col cols="2">
                <v-text-field v-model="forms.textbox" label="テキストボックス" hide-details> </v-text-field>
            </v-col>
            <v-spacer></v-spacer>
            <v-col cols="2" class="text-right mt-2">
                <v-btn color="primary" width="80">
                    クリア
                </v-btn>
                <v-btn color="primary" width="80">
                    検索
                </v-btn>
            </v-col>
        </v-row>
        <v-row>
            <v-col>
                <v-data-table :headers="headers" :items="desserts" sort-by="calories" class="elevation-1" fixed-header  height="60vh">
                    <template v-slot:top>
                        <v-toolbar flat height="48">
                            <v-toolbar-title>〇〇一覧</v-toolbar-title>
                            <v-spacer></v-spacer>
                            <router-link v-bind:to="{name: 'form', params: {id: null , mode:'C'}}">
                                <v-btn color="primary" width="80">
                                    追加
                                </v-btn>
                            </router-link>

                        </v-toolbar>
                    </template>
                    <template v-slot:item.actions="{ item }">

                        <router-link v-bind:to="{name: 'form', params: {id: item.carbs , mode:'R'}}">
                            <v-icon small class="mr-2">mdi-magnify</v-icon>
                        </router-link>
                        <router-link v-bind:to="{name: 'form', params: {id: item.carbs, mode:'U' }}">
                            <v-icon small class="mr-2">mdi-pencil</v-icon>
                        </router-link>
                        <router-link v-bind:to="{name: 'form', params: {id: item.carbs, mode:'D' }}">
                            <v-icon small >mdi-delete</v-icon>
                        </router-link>

                    </template>
                    <template v-slot:no-data>
                        データがありません。
                    </template>
                </v-data-table>

            </v-col>

        </v-row>
    </v-container>
</template>
<script>
export default {
    data: () => ({
        constant: {				// ②
            RADIOS: {},
            SELECTS: [],
            CHECKS: {},
        },

        forms: {				// ③
            textbox: '',
            textarea: '',
            radiobtn: '1',
            select: '',
            checkbox: [],
        },

        dialog: false,
        dialogDelete: false,
        headers: [
            {
                text: 'Dessert (100g serving)',
                align: 'start',
                sortable: false,
                value: 'name',
            },
            { text: 'Calories', value: 'calories' },
            { text: 'Fat (g)', value: 'fat' },
            { text: 'Carbs (g)', value: 'carbs' },
            { text: 'Protein (g)', value: 'protein' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },
    },

    created() {
        this.initialize()
    },

    methods: {
        initialize() {

            let constData = {
                "RADIOS": {
                    "1": "Radio1",
                    "2": "Radio2",
                    "3": "Radio3"
                },
                "SELECTS": {
                    "1": "Select1",
                    "2": "Select2",
                    "3": "Select3",
                    "4": "Select4"
                },
                "CHECKS": {
                    "1": "Check1",
                    "2": "Check2",
                    "3": "Check3",
                    "4": "Check4",
                    "5": "Check5",
                    "6": "Check6",
                    "7": "Check7",
                    "8": "Check8"
                }
            };



            this.constant.RADIOS = constData.RADIOS;
            this.constant.SELECTS = Object.entries(constData.SELECTS).map(([key, name]) => ({ 'id': key, 'name': name }))
            this.constant.CHECKS = constData.CHECKS;



            this.desserts = [
                {
                    name: 'Frozen Yogurt1',
                    calories: 159,
                    fat: 6.0,
                    carbs: 24,
                    protein: 4.0,
                },
                {
                    name: 'Ice cream sandwich',
                    calories: 237,
                    fat: 9.0,
                    carbs: 37,
                    protein: 4.3,
                },
                {
                    name: 'Eclair',
                    calories: 262,
                    fat: 16.0,
                    carbs: 23,
                    protein: 6.0,
                },
                {
                    name: 'Cupcake',
                    calories: 305,
                    fat: 3.7,
                    carbs: 67,
                    protein: 4.3,
                },
                {
                    name: 'Gingerbread',
                    calories: 356,
                    fat: 16.0,
                    carbs: 49,
                    protein: 3.9,
                },
                {
                    name: 'Jelly bean',
                    calories: 375,
                    fat: 0.0,
                    carbs: 94,
                    protein: 0.0,
                },
                {
                    name: 'Lollipop',
                    calories: 392,
                    fat: 0.2,
                    carbs: 98,
                    protein: 0,
                },
                {
                    name: 'Honeycomb',
                    calories: 408,
                    fat: 3.2,
                    carbs: 87,
                    protein: 6.5,
                },
                {
                    name: 'Donut',
                    calories: 452,
                    fat: 25.0,
                    carbs: 51,
                    protein: 4.9,
                },
                {
                    name: 'KitKat',
                    calories: 518,
                    fat: 26.0,
                    carbs: 65,
                    protein: 7,
                },
            ]
        },

        editItem(item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
        },

        deleteItem(item) {
            this.editedIndex = this.desserts.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.desserts.splice(this.editedIndex, 1)
            this.closeDelete()
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save() {
            if (this.editedIndex > -1) {
                Object.assign(this.desserts[this.editedIndex], this.editedItem)
            } else {
                this.desserts.push(this.editedItem)
            }
            this.close()
        },
    },
}
</script>
<style>
.cond>.col {
    padding-top: 8px !important;
    padding-bottom: 8px !important;
}
a {text-decoration: none}
</style>